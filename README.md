Endpoint: /api/{user}/send?api_token=your_api_token
![image](https://github.com/adecuseara/laravel-9/assets/58728571/d05b690d-3a5f-4103-b2ad-805d022080c2)

Endpoint: /api/{user}/token -> generate a token for a specific user
![image](https://github.com/adecuseara/laravel-9/assets/58728571/adea30e4-e9db-4182-972a-99e0e32783a2)

Endpoint: /api/list
![image](https://github.com/adecuseara/laravel-9/assets/58728571/58457e08-2abc-4344-b01f-39aeafc19b42)


<p align="center"><a href="https://autoklose.com" target="_blank"><img src="https://app.autoklose.com/images/svg/autoklose-logo-white.svg" width="400"></a></p>

## Instructions
The repository for the assignment is public and Github does not allow the creation of private forks for public repositories.

The correct way of creating a private fork by duplicating the repo is documented here.

For this assignment the commands are:

Create a bare clone of the repository.

git clone --bare git@github.com:autoklose/laravel-9.git
Create a new private repository on Github and name it laravel-9.

Mirror-push your bare clone to your new repository.

Replace <your_username> with your actual Github username in the url below.

cd laravel-9.git
git push --mirror git@github.com:<your_username>/laravel-9.git
Remove the temporary local repository you created in step 1.

cd ..
rm -rf laravel-9.git
You can now clone your laravel-9 repository on your machine (in my case in the code folder).

cd ~/code
git clone git@github.com:<your_username>/laravel-9.git
