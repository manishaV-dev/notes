<?php
//start session 
session_start();

//if seesion start or if not true then not able see welcome page
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
  header("location: index.php");
  exit;
}

?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>My iNotes</title>
  </head>
  <body>
    <!-- <h1>This is my To-List-App</h1> -->

    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <i class="fas fa-list-alt"></i> My iNotes
         </a>
         <form class="d-flex gap-2 d-md-block">
        <a href="logout.php">
        <button type="button" class="btn btn-secondary btn-sm ">Log out</button>
        </a>
      </form>
        </div>
      </nav>

      <div class="container my-4">
          <h2 class="text-center">My iNote</h2>
            
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" id="title" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">Add an item to the list</div>
            </div>

            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <textarea class="form-control" id="desc" rows="3"></textarea>
              </div>
            
            <button type="submit" class="btn btn-primary" id="add">Add to List</button>
            <button  class="btn btn-primary" id="clear" onclick="cleanStorage()">Clear List</button>

            <div id="items" class="my-4">
                <h2>Your Items</h2>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">SNo.</th>
                        <th scope="col">Item_Title</th>
                        <th scope="col">Item_Description</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody id="tableBody">
                      <tr>
                        <th scope="row">1</th>
                        <td>Get Some Coffee</td>
                        <td>You need a coffee as you are a coder.</td>
                        <td><button class="btn btn-sm btn-primary">Delete</button></td>
                      </tr>
                    </tbody>
                  </table>
            </div>

      </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->

    <script>

        function getAndUpdate(){
            tit = document.getElementById('title').value;
            desc = document.getElementById('desc').value;
            
            if(localStorage.getItem('itemJson')==null){
                itemJsonArray = [];
                itemJsonArray.push([tit,desc]);
                localStorage.setItem('itemJson' , JSON.stringify(itemJsonArray))
            }

            else{
                itemJsonArrayStr = localStorage.getItem('itemJson')
                itemJsonArray = JSON.parse(itemJsonArrayStr);
                itemJsonArray.push([tit,desc]);
                localStorage.setItem('itemJson' , JSON.stringify(itemJsonArray))
            }
            update();

        }

        function update(){
            if(localStorage.getItem('itemJson')==null){
                itemJsonArray = [];
                localStorage.setItem('itemJson' , JSON.stringify(itemJsonArray))
            }

            else{
                itemJsonArrayStr = localStorage.getItem('itemJson')
                itemJsonArray = JSON.parse(itemJsonArrayStr);
            }

            //populate the table
            let tableBody = document.getElementById("tableBody");
            let str = "";
            itemJsonArray.forEach((element, index) =>{
                str += `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${element[0]}</td>
                            <td>${element[1]}</td>
                            <td><button class="btn btn-sm btn-primary" onclick="deleted(${index})">Delete</button></td>
                        </tr>
                    `;
            });

            tableBody.innerHTML = str;
        }
        add = document.getElementById("add");
        add.addEventListener("click", getAndUpdate);
        update();

        function deleted(itemIndex){
                itemJsonArrayStr = localStorage.getItem('itemJson')
                itemJsonArray = JSON.parse(itemJsonArrayStr);
                
                //delete itemIndex element from the array.

                itemJsonArray.splice(itemIndex,1);
                localStorage.setItem('itemJson', JSON.stringify(itemJsonArray));
                update();
        }

        function cleanStorage(){
                if(confirm("Do you really want to clear all items?")){
                    localStorage.clear();
                    update();
                }
        }

    </script>
  </body>
</html>