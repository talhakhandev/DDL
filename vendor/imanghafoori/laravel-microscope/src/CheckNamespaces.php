<?php

namespace Imanghafoori\LaravelMicroscope;

use Illuminate\Support\Str;
use Imanghafoori\LaravelMicroscope\ErrorReporters\ErrorPrinter;
use Imanghafoori\LaravelMicroscope\FileReaders\FilePath;
use Imanghafoori\LaravelMicroscope\Psr4\NamespaceCorrector;
use Imanghafoori\TokenAnalyzer\GetClassProperties;

class CheckNamespaces
{
    public static $checkedNamespaces = 0;

    public static $changedNamespaces = [];

    /**
     * Get all of the listeners and their corresponding events.
     *
     * @param  $composerPath
     * @param  $composerNamespace
     * @param  $command
     * @return void
     */
    public static function within($composerPath, $composerNamespace, $detailed)
    {
        $paths = FilePath::getAllPhpFiles($composerPath);

        foreach ($paths as $classFilePath) {
            $absFilePath = $classFilePath->getRealPath();

            // exclude blade files
            if (Str::endsWith($absFilePath, ['.blade.php'])) {
                continue;
            }

            if (! self::hasOpeningTag($absFilePath)) {
                continue;
            }

            [
                $currentNamespace,
                $class,
                $type,
                $parent,
            ] = GetClassProperties::fromFilePath($absFilePath, config('microscope.class_search_buffer', 2500));

            // Skip if there is no class/trait/interface definition found.
            // For example a route file or a config file.
            if (! $class || $parent == 'Migration') {
                continue;
            }

            $detailed && event('microscope.checking', [$classFilePath->getRelativePathname()]);

            $relativePath = FilePath::getRelativePath($absFilePath);
            $correctNamespace = NamespaceCorrector::calculateCorrectNamespace($relativePath, $composerPath, $composerNamespace);
            self::$checkedNamespaces++;

            if ($currentNamespace === $correctNamespace) {
                continue;
            }

            // Sometimes, the class is loaded by other means of auto-loading
            if (! CheckClassReferencesAreValid::isAbsent($currentNamespace.'\\'.$class)) {
                continue;
            }

            self::changedNamespaces($class, $currentNamespace, $correctNamespace);
            ErrorPrinter::warnIncorrectNamespace($currentNamespace, $relativePath, $class);

            event('microscope.wrong_namespace', [$relativePath, $currentNamespace, $correctNamespace]);
        }
    }

    public static function hasOpeningTag($file)
    {
        $fp = fopen($file, 'r');

        if (feof($fp)) {
            return false;
        }

        $buffer = fread($fp, 20);
        fclose($fp);

        return Str::startsWith($buffer, '<?php');
    }

    public static function doNamespaceCorrection($absFilePath, $currentNamespace, $correctNamespace)
    {
        event('laravel_microscope.namespace_fixing', get_defined_vars());
        NamespaceCorrector::fix($absFilePath, $currentNamespace, $correctNamespace);
        event('laravel_microscope.namespace_fixed', get_defined_vars());
    }

    private static function changedNamespaces($class, $currentNamespace, $correctNamespace)
    {
        $_currentClass = $currentNamespace.'\\'.$class;
        $_correctClass = $correctNamespace.'\\'.$class;
        $relPath = NamespaceCorrector::getRelativePathFromNamespace($currentNamespace);
        if (is_dir(base_path($relPath.DIRECTORY_SEPARATOR.$class))) {
            self::$changedNamespaces[$_currentClass.';'] = $_correctClass.';';
            self::$changedNamespaces[$_currentClass.'('] = $_correctClass.'(';
            self::$changedNamespaces[$_currentClass.'::'] = $_correctClass.'::';
            self::$changedNamespaces[$_currentClass.' as'] = $_correctClass.' as';
        } else {
            self::$changedNamespaces[$_currentClass] = $_correctClass;
        }
    }
}
