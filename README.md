gzone-library
=============
### Register Service provider on config/app.php: 
`'Sondt87\GzoneLibrary\GzoneLibraryServiceProvider'`

How to use
=============

### make controller
`php artisan util:make_controller [name]`
##### example
`php artisan util:make_controller User`
##### 5 files is generated:
##### results
     app 
      |__ controllers
                  |__ User
                         |__ APIController.php
                         |__ BackendController.php
                         |__ BaseController.php
                         |__ FrontendController.php
                         |__ Interface.php
                         
                      

### make repository
`php artisan util:make_repository [name] [folder_path]`

##### example
`php artisan util:make_repository User Demo/Repo`

##### results
    app
     |__ Demo
          |__ Repo
                |__ User
                |       |__ UserRepository.php
                |       |__ EloquentUserRepository.php
                |      
                |__ AbstractRepository.php
                |__ IRepository
