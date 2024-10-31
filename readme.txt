=== No 404 Errors ===

Tags: 404, errors, garbage 
Requires at least: 2.6
Tested up to: 2.9
Stable tag: 0.1.1

Allow 404 errors to redirect to a specific page (as a 301).

== Description ==

Save your visitors from garbage 404 errors!

Some shared hosting providers intercept 404 errors to provide their own custom error pages.  Unfortunately this interferes with
WordPress and causes raw html to be sent to the browser.  This plugin changes 404 errors to 301 errors and redirects to a known page.

See the [No 404 homepage](http://bramernic.com/no404) for more information.

== Installation ==

1. Unzip the package, and upload `no-404-errors` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Set up a page to redirect to and enter it's number in the `No 404 Errors` settings page.

== Other considerations ==

You will probably want to add the error page number into an exclude list when using wp_list_pages.  Another approach is to make the page private, but the downside is that "Private:" is then pre-pended to the title string.

== Changes ==

* 0.1.1: Initial version
