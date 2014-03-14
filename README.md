Websublime\Config
========
[![Build Status](https://travis-ci.org/websublime/config.png?branch=master)](https://travis-ci.org/websublime/config)

##Syntax
Config component is a package based on Symfony Config where it is used as a catalogue of configurations. It can be inserted or just loading from two types of files: yml and php. We do not have made more supported files because it is this kind of files that we most use.

##How To Use
First create an instance of wich type of loader for the file you want to use.

	$yaml = new YamlConfigLoader('/path/where/config/will/be');
	
Then create an instance of Config and set the loader resolver.

	$config = new Config();
    $config->setConfigResolver($yaml);
    
After, you have to import your configuration file.

	$config->import('myconfig.yml');
	
The import method is void. The configuration is added to ConfigCatalogue were you can interact in Config. Lets say your config fil have:

	config:
		key: 'My new option'
		
When you import your configuration file it is registered in ConfigCatalogue with the name of your file without extension and if it is an array multidimensional it will be transformer in a flatten array. So to get our value from our config we call:

	$config->get('myconfig.config.key');
	
The methods present in ConfigCatalogue are:

	ConfigCatalogue->get($key);
	ConfigCatalogue->add($value, $key=null);
	ConfigCatalogue->remove($key);
	ConfigCatalogue->exist($key);
	ConfigCatalogue->all();
	
Of course it isn't mandatory to use a file of configurations. You can use it without one. Just instantiate the Config and you are rock and load to use the ConfigueCatalogue methods.

## Changelog
	- Added version 0.2
	- Added support for loading php files for configs
	- Added methods getDelegateLoader() and getLoaderResolver() on ConfigResolver.
