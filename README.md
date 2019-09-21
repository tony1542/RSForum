# To first run the program:
- `composer install` or `composer update`
- `php -S localhost:9001` to actually serve the application
- Visit `localhost:9001` in a browser to interact with it

# To create a new local branch based off of an existing branch
First, switch to whatever branch you want to copy. In this example, we'll copy the `master` branch
- git checkout master
- git checkout -b new_branch_name_here
You'll now have a `new_branch_name_here` branch that is a copy of `master`

# HTML / Layouts / Formatting
We use [Bootstrap 4.3](https://getbootstrap.com/docs/4.3/layout/overview/), click the link to see how-tos for what classes to use and how the layouts work

# Routing breakdown / example
 Example (these classes might not exist yet, they are just to help understand how the routing works)
 let's say we have this as a URL "`/Character/Show/23`"
 - the 1st spot, `Character`, is our controller (`CharactersController`)
 - the 2nd spot, '`Show`' is the function we are calling (`CharactersController->show()`)
 - the 3rd spot (optional), is the ID we are passing (`CharactersController->show(23)`)
 
 This might be hard to understand at first, but we can break it down and try a bunch of examples to show how it works
 
 Also the try/catch is a concept that isn't important to know for now.
 Just know that it will catch errors that are thrown and will be displayed in our '/partials/error.php' template!
