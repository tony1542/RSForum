# To create a new local branch based off of an existing branch
First, switch to whatever branch you want to copy. In this example, we'll copy the `master` branch
- `git checkout master`
- `git checkout -b new_branch_name_here`
You'll now have a `new_branch_name_here` branch that is a copy of `master`

# Undo any local changes to 'clean-slate' your git branch
- `git checkout .`
- `git clean -f`

# Roll-back to a specific commit
- `git reset --hard <hash-or-ref>`
- `git push`
