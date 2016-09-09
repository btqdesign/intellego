<?php
/**
 *
 * Plugin Name: File Manager
 * Author Name: Aftabul Islam
 * Version: 4.0.3
 * Author Email: toaihimel@gmail.com
 * License: GPLv2
 * Description: Manage your file the way you like. You can upload, delete, copy, move, rename, compress, extract files. You don't need to worry about ftp. It is realy simple and easy to use.
 *
 * */

// Including elFinder class
require_once('elFinder/elFinder.php');

// Including bootstarter
require_once('BootStart/__init__.php');

class FM extends FM_BootStart {

	public function __construct($name){

		// Adding Menu
		$this->menu_data = array(
			'type' => 'menu',
		);

		// Adding Ajax
		$this->add_ajax('connector'); // elFinder ajax call
		$this->add_ajax('valid_directory'); // Checks if the directory is valid or not

		parent::__construct($name);
		
		// Adding plugins page links
		add_filter('plugin_action_links', array(&$this, 'plugin_page_links'), 10, 2);
		
	}

	/**
	 *
	 * File manager connector function
	 *
	 * */
	public function connector(){
		
		//~ Holds the list of avilable file operations.
		$file_operation_list = array( 
			'open', // Open directory
			'ls',   // File list inside a directory
			'tree', // Subdirectory for required directory
			'parents', // Parent directory for required directory 
			'tmb', // Newly created thumbnail list  
			'size', // Count total file size 
			'mkdir', // Create directory
			'mkfile', // Create empty file
			'rm', // Remove dir/file
			'rename', // Rename file
			'duplicate', // Duplicate file - create copy with "copy %d" suffix
			'paste', // Copy/move files into new destination
			'upload', // Save uploaded file
			'get', // Return file content
			'put', // Save content into text file
			'archive', // Create archive
			'extract', // Extract files from archive
			'search', // Search files
			'info', // File info
			'dim', // Image dimmensions 
			'resize', // Resize image
			'url', // content URL
			'ban', // Ban a user
			'copy', // Copy a file/folder to another location
			'cut', // Cut for file/folder
			'edit', // Edit for files
			'upload', // Upload A file
			'download', // download A file
			);
		
		// Disabled file operations
		$file_operation_disabled = array( 'url', 'info' );
		
		// Allowed mime types 
		$mime_allowed = array( 
			'text',
			'image', 
			'video', 
			'audio', 
			'application',
			'model',
			'chemical',
			'x-conference',
			'message',
			 
			);
			
		$mime_denied = array();
		
		$opts = array(
			'debug' => true,
			'roots' => array(
				array(
					'driver'        => 'LocalFileSystem',           // driver for accessing file system (REQUIRED)
					'path'          => ABSPATH,                     // path to files (REQUIRED)
					'URL'           => site_url(),                  // URL to files (REQUIRED)
					'uploadDeny'    => $mime_denied,                // All Mimetypes not allowed to upload
					'uploadAllow'   => $mime_allowed,               // Mimetype `image` and `text/plain` allowed to upload
					'uploadOrder'   => array('allow', 'deny'),      // allowed Mimetype `image` and `text/plain` only
					'accessControl' => 'access',
					'disabled'      => $file_operations_disabled    // List of disabled operations
					//~ 'attributes'
				)
			)
		);

		$elFinder = new FM_EL_Finder();
		$elFinder = $elFinder->connect($opts);
		$elFinder->run();

		die();
	}
	
	/**
	 * 
	 * Adds plugin page links,
	 * 
	 * */
	public function plugin_page_links($links, $file){
		
		static $this_plugin;
		
		if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);
		 
		if ($file == $this_plugin){
			array_unshift( $links, '<a target=\'blank\' href="http://www.giribaz.com/support/">'.__("Support", "file-manager").'</a>');
			
			array_unshift( $links, '<a href="admin.php?page=file-manager_settings">'.__("File Manager", "file-manager").'</a>');
				
			if( !defined('FILE_MANAGER_PREMIUM') && !defined('FILE_MANAGER_BACKEND') )
				array_unshift( $links, '<a target=\'blank\' class="file-manager-admin-panel-pro" href="http://www.giribaz.com/wordpress-file-manager-plugin/" style="color: white; font-weight: bold; background-color: red; padding-right: 5px; padding-left: 5px; border-radius: 40%;">'.__("Pro", "file-manager").'</a>');
		
		}
		
		return $links;
	}
	
}

global $FileManager;
$FileManager = new FM('File Manager');
