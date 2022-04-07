<?php
namespace Donation\Inc\Helpers;

/**
 * Auto loader function.
 *
 * @param string $resource Source namespace.
 *
 * @return void
 */
function autoloader($resource = '')
{
    $resource_path = false;
    $namespace_root = 'Donation\\';
    $resource = trim($resource, '\\');

    if (empty($resource) || strpos($resource, '\\') === false || strpos($resource, $namespace_root) !== 0) {
        // Not our namespace, bail out.
        return;
    }

    // Remove our root namespace.
    $resource = str_replace($namespace_root, '', $resource);

    $path = explode(
        '\\',
        $resource
    );

    /**
     * Time to determine which type of resource path it is,
     * so that we can deduce the correct file path for it.
     */

    if (empty($path[0]) || empty($path[1])) {
        return;
    }

    $directory = '';
    $file_name = '';

	
    if ('Inc' === $path[0]) {

        switch ($path[1]) {
            case 'Traits':
                $directory = 'traits';
				$file_name = $path[2];
                break;
            default:
                $directory = 'classes';
                $file_name = $path[2];
                break;
        }

        $resource_path = sprintf('%s/inc/%s/%s.php', untrailingslashit(DONATION_THEME_DIR_PATH), $directory, $file_name);
    }

    /**
     * If $is_valid_file has 0 means valid path or 2 means the file path contains a Windows drive path.
     */
    $is_valid_file = validate_file($resource_path);

    if (!empty($resource_path) && file_exists($resource_path) && (0 === $is_valid_file || 2 === $is_valid_file)) {
        // We already making sure that file is exists and valid.

        require_once $resource_path; // phpcs:ignore
    }

}

spl_autoload_register('\Donation\Inc\Helpers\autoloader');
