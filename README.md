# Aegis Framework: Ikaros

Aegis is a simple but powerful framework for both new and experienced developers that aims to be as minimal as it can get while keeping the features you need to create an amazing site or application.

Ikaros is the PHP flavor of Aegis.

## Requirements:
* Web server (Apache or Nginx)
* PHP 5.5 or higher

## Getting Started
### 1. Get the latest Release
You can find the latest release in the [releases page](https://github.com/AegisFramework/Ikaros/releases)

### 2. Setup your Project
Extract the contents and rename your project's directory

#### 2.1 Configure the Router
The index.php file has the following domain set to the Router by default:
 ```php
Router::$domain = "localhost/Ikaros";
```

You'll want to change it to your project's location:

```php
Router::$domain = "localhost/YourDirectory";
```
#### 2.2 Configure the .htaccess file

You'll also need to set the Base Route in the .htaccess by changing the following line in it:

```
RewriteBase /Ikaros
```

Just as with the router, change it to your path.

```
RewriteBase /YourDirectory
```
## 3. Start Coding!