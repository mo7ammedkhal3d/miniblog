<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Links -->

    <link rel="stylesheet" href="{{asset('assets/lib/fontawesome-v6.4.2/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('assets/lib/bootstrap.min.css')}}">

    <!-- #region style -->

<style>
    .modal-dialog{
        max-width: 50rem;
        margin: 6% auto;
    }
    .modal-center {
        top: 30% !important;
        transform: translateY(-50%) !important;
    }

    .modal-Img {
        width: 16vw;
        height: 30vh;
        display: block;
        font-size: 25px;
        border-radius: 0.5rem;
        border: 1px solid teal;
        display: flex;
        text-align: center;
    }

    .non-resizable {
        resize: none;
        overflow-y: auto;
    }

    .action-icon {
        font-size: 18px;
        font-weight: bold;
        color: white;
    }

    table tr th:first-of-type {
        width: 12%;
    }

    table tr th:last-of-type {
        width: 20%;
    }

    table input[type="checkbox"] {
        cursor: pointer;
    }

    .input-searsh {
        position: relative;
        display: inline-block;
        width: 35%;
    }

    .searsh-icon {
        position: absolute;
        right: 2%;
        font-size: 18px;
        top: 26%;
        color: lightgray;
    }

    .btn-dropdown-custom {
        width: 100%;
        border-radius: 0px;
    }

    .plus-icon {
        font-size: 15px;
        margin-right: 10px;
    }

    .position-custom {
        position: absolute;
        right: 1%;
        top: 2%;
    }
</style>
    <!-- #endregion -->

    <title>MINI BLog</title>
</head>

<body>
    <!-- #region HTML-->
    <div style="position: relative;" class="container">


        <!--#region Add Modal -->

        <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create New</h5>
                        <button type="button" class="close btn-close-modal" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row m-0 p-0">    
                            <div class="col-8">
                                <form id="add-form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="text" class="form-control mb-3" name="title" placeholder="title" aria-label="title" aria-describedby="basic-addon1">
                                    <select id="Aauthors" class="form-select form-select-sm mb-3" name="author_id" aria-label=".form-select-sm example">
                                        <option selected="">author</option>
                                    </select>
                                    <textarea type="text" name="content" class="form-control mb-3 non-resizable" rows="5" cols="50" placeholder="conetnt" aria-label="title" aria-describedby="basic-addon1"></textarea>
                                    <input onchange="loadFile('Aimg-load',event)"   type="file" name="upload" class="form-control form-control-sm mb-3" aria-label="Small file input example">
                                </form>
                            </div>  
                            <div class="col-4">
                                <img id="Aimg-load" class="modal-Img" alt="Post Image">
                            </div>                  
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-close-modal"> Close</button>
                        <button id="btn-add" type="button" class="btn btn-success">Add</button>
                    </div>
                </div>
            </div>
        </div>

        <!--#endregion Add Modal -->

        <!--#region Details Modal -->

        <div class="modal fade" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-center" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                        <button type="button" class="close btn-close-modal" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row m-0 p-0">    
                            <div class="col-8">
                                <form id="detial-form" enctype="multipart/form-data">
                                    <input readonly id="d-title" type="text" class="form-control mb-3" name="title" placeholder="title" aria-label="title" aria-describedby="basic-addon1">
                                    <input readonly id="Dauthors" type="text" class="form-control mb-3" name="title" placeholder="title" aria-label="title" aria-describedby="basic-addon1">
                                    <textarea readonly id="d-content" type="text" name="content" class="form-control mb-3 non-resizable" rows="5" cols="50" placeholder="conetnt" aria-label="title" aria-describedby="basic-addon1"></textarea>
                                </form>
                            </div>  
                            <div class="col-4">
                                <img id="Dimg-load" class="modal-Img" alt="Post Image">
                            </div>                  
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-close-modal"> Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!--#endregion Details Modal -->

        <!--#region Edit Modal -->

        <div class="modal fade" id="e-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-center" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit register</h5>
                        <button type="button" class="close btn-close-modal" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row m-0 p-0">    
                            <div class="col-8">
                                <form id="edit-form" enctype="multipart/form-data">
                                    <input id="e-title" type="text" class="form-control mb-3" name="title" placeholder="title" aria-label="title" aria-describedby="basic-addon1">
                                    <select id="Eauthors" class="form-select form-select-sm mb-3" name="authorId" aria-label=".form-select-sm example">
                                    </select>
                                    <textarea id="e-content" type="text" name="content" class="form-control mb-3 non-resizable" rows="5" cols="50" placeholder="conetnt" aria-label="title" aria-describedby="basic-addon1"></textarea>
                                    <input onchange="loadFile('Eimg-load',event)"   type="file" name="upload" class="form-control form-control-sm mb-3" aria-label="Small file input example">
                                </form>
                            </div>  
                            <div class="col-4">
                                <img id="Eimg-load" class="modal-Img" alt="Post Image">
                            </div>                  
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-close-modal"> Close</button>
                        <button id="btn-edit" type="button" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </div>
        </div>

        <!--#endregion Edit Modal -->

        <!--#region Delete Modal -->
        <div class="modal fade" id="d-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-center" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete !!</h5>
                        <button type="button" class="close btn-close-modal" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you shure about that you i,ll delete this registered
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-close-modal"> Close</button>
                        <button id="btn-delete" type="button" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!--#endregion Delete Modal -->

        <div class="input-searsh mt-3 mb-3">
            <input class="form-control" type="text" id="searsh-input" onkeyup="Searsh()"
                placeholder="Inser name to searsh ....">
            <i class="fa-solid fa-magnifying-glass searsh-icon"></i>
        </div>
        <div class="dropdown position-custom">
            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Actions
            </button>
            <ul class="dropdown-menu">
                <li><button onclick="addregister()" class="btn btn-success btn-dropdown-custom"><i
                            class="fa fas fa-plus plus-icon"></i>Add New</button></li>
                <li><button onclick="DeleteSelected()" class="btn btn-danger btn-dropdown-custom">Delete
                        Selected</button></li>
                <li class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
        <table class="table table-responsive table-bordered table-striped mt-3 mb-3 text-center">
            <tr>
                <th>
                    <label class="form-label"><input onchange="selectAll()" style="margin-right: 5px;"
                            class="form-check-input" type="checkbox"> Select All</label>
                </th>
                <th>
                    Title
                </th>
                <th>
                    Author
                </th>
                <th>
                    Date
                </th>
                <th>
                    Action
                </th>
            </tr>
        </table>
    </div>
    <!-- #endregion -->

    <!-- Scripts -->
    <script src="{{asset('assets/lib/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/lib/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('assets/lib/bootstrap.bundle.min.js')}}"></script>

    <script>

        var postId;

        //#region Searsh 

        function Searsh() {
            let input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searsh-input");
            filter = input.value.toUpperCase();
            table = document.getElementsByTagname('table')[0];
            tr = table.querySelectorAll('table tr:not(:first-of-type)');

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagname("td")[1];
                if (td) {
                    txtValue = td.textcontent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
                td = tr[i].getElementsByTagname("td")[2];
                if (td) {
                    txtValue = td.textcontent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    }
                }
            }
        }

        //#endregion Searsh 
      
        //#region AddConfirm

        function addregister(){

            const Closebuttons = document.querySelectorAll('.btn-close-modal');
            Closebuttons.forEach(function (btnClose) {
                btnClose.addEventListener('click', function (){
                    $('form')[0].reset();
                    $('img')[0].src="";
                    $('#Aauthors').html(`<option selected="">author</option>`);
                    $('#add-modal').modal('hide');
                });
            });

            fetch('http://127.0.0.1:8000/authors', {
                method: 'GET',
            })
            .then(response => {  
                if (!response.ok) {
                throw new Error('Network response was not ok');
                }
                return response.json();
            })
                .then(data => { data
                    data.forEach(author => {
                        $('#Aauthors').eq(0).append(`
                            <option value="${author.id}">${author.name}</option>
                         `)
                    });
                })
                .catch(error => {
                    console.error('Error during fetch operation:', error);
                });


            $('#add-modal').modal('show');

            
        }

        //#endregion 

        //#region Refresh
        
        function refresh(){
            fetch('http://127.0.0.1:8000/posts', {
                method: 'GET',
            })
            .then(response => {  
                if (!response.ok) {
                throw new Error('Network response was not ok');
                }
                return response.json();
            })
                .then(data => { data
                    $('tr:has(td)').remove();
                    data.forEach(Post =>{
                        $('tbody').eq(0).append(`
                            <tr>
                                <td><input class="form-check-input"  type="checkbox"></td>
                                <td>${Post.title}</td>
                                <td>${Post.author.name}</th>
                                <td>${Post.published_at}</th>
                                <td>
                                    <button onclick="editConfirm(this)" class="btn btn-info"><i class="fa-regular fa-pen-to-square action-icon"></i></button>
                                    <button onclick="showDetails(this)" class="btn btn-primary"><i class="fa-solid fa-file-contract action-icon"></i></button>
                                    <button onclick="deleteConfirm(this)" class="btn btn-danger"><i class="fa-solid fa-trash-can action-icon"></i></button>
                                </td>
                                <input type="hidden" value="${Post.id}">
                            </tr>
                         `)
                    });
                })
                .catch(error => {
                    console.error('Error during fetch operation:', error);
                });
        }

        //#endregion 

        //#region LoadFile

        var loadFile = function (str, event) {
        var image = $('#' + str);
        image.attr('src', URL.createObjectURL(event.target.files[0]));
        };
        
        //#endregion 
        
        //#region Details

        function showDetails(button) {
            const Closebuttons = document.querySelectorAll('.btn-close-modal');
            Closebuttons.forEach(function (btnClose) {
                btnClose.addEventListener('click', function () {
                    $('#details-modal').modal('hide');
                });
            });

            fetch('http://127.0.0.1:8000/authors', {
            method: 'GET',
            })
            .then(response => {  
                if (!response.ok) {
                throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => { data
                data.forEach(author => {
                    $('#Dauthors').eq(0).val(author.name);
                });
            })
            .catch(error => {
                console.error('Error during fetch operation:', error);
            });

            let row = button.parentNode.parentNode;
            const postId = parseInt(row.querySelectorAll('input[type="hidden"]')[0].value);
            fetch(`http://127.0.0.1:8000/posts/${postId}`,{
                method: 'GET',
            })
            .then(response => {  
                if (!response.ok) {
                throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(Post => { Post
                // data.forEach(Post =>{
                    $('#d-title').val(Post.title);
                    $('#d-content').html(Post.content);
                    $('#Dimg-load').attr('src', `{{ asset('/assets/uploads/${Post.imgUrl}')}}`);
                // });
            })
            .catch(error => {
                console.error('Error during fetch operation:', error);
            });

            $('#details-modal').modal('show');         
        }

        //#endregion Details

        //#region Editconfirm

        function editConfirm(button) {      
            const Closebuttons = document.querySelectorAll('.btn-close-modal');
            Closebuttons.forEach(function (btnClose) {
                btnClose.addEventListener('click', function(){
                    $('form')[0].reset();
                    $('img')[0].src="";
                    $('#Eauthors').html("");
                    $('#e-modal').modal('hide');
                });
            });

            fetch('http://127.0.0.1:8000/authors', {
            method: 'GET',
            })
            .then(response => {  
                if (!response.ok) {
                throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => { data
                data.forEach(author => {
                    $('#Eauthors').eq(0).append(`
                        <option value="${author.id}">${author.name}</option>
                        `)
                });
            })
            .catch(error => {
                console.error('Error during fetch operation:', error);
            });

            let row = button.parentNode.parentNode;
            postId = parseInt(row.querySelectorAll('input[type="hidden"]')[0].value);
            fetch(`http://127.0.0.1:8000/posts/${postId}`, {
                method: 'GET',
            })
            .then(response => {  
                if (!response.ok) {
                throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(Post => { Post
                    $('#Eauthors').val(Post.authorId);
                    $('#e-title').val(Post.title);
                    $('#e-content').html(Post.content);
                    $('#Eimg-load').attr('src', '{{ asset("assets/upload/posts/") }}' + '/' + Post.imgUrl);
            })
            .catch(error => {
                console.error('Error during fetch operation:', error);
            });

            $('#e-modal').modal('show');     
        }


        //#endregion Edit

        //#region Delete

        //#region Delete one register

        function deleteConfirm(button) {
            $('#d-modal').modal('show');
            const Closebuttons = document.querySelectorAll('.btn-close-modal');
            let row = button.parentNode.parentNode;
            postId = parseInt(row.querySelectorAll('input[type="hidden"]')[0].value);
            Closebuttons.forEach(function (btnClose) {
                btnClose.addEventListener('click', function () {
                    $('#d-modal').modal('hide');
                });
            });
        }

        //#endregion 

        //#region Delete Multi register

        function DeleteSelected() {
            $('#d-modal').modal('show');
            const btnDelete = document.getElementById('btn-delete');
            const Closebuttons = document.querySelectorAll('.btn-close-modal');

            Closebuttons.forEach(function (btnClose) {
                btnClose.addEventListener('click', function () {
                    $('#d-modal').modal('hide');
                });
            });
        }

        //#endregion Delete Multi register

        //#endregion Delete 

        //#region selectAll
        
        function selectAll() {
                let selectAllCheckbox = document.querySelector('table tr:first-of-type th:first-of-type input[type="checkbox"]');
                if (selectAllCheckbox.checked == true) {
                    let checkboxes = document.querySelectorAll('table tr td input[type="checkbox"]');
                    checkboxes.forEach(function (checkbox) {
                        checkbox.checked = true;
                    });
                }
                else {
                    let checkboxes = document.querySelectorAll('table tr td input[type="checkbox"]');
                    checkboxes.forEach(function (checkbox) {
                        checkbox.checked = false;
                    });
                }
            }
        //#endregion selectAll
        
        
        $(document).ready(function(){
            refresh();

            //#region Add
            const btnAdd = document.getElementById('btn-add');

            btnAdd.addEventListener('click', function (){
                var formData = new FormData(document.getElementById('add-form'));
                fetch('http://127.0.0.1:8000/posts/', {
                method: 'POST',
                body: formData,
                headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')}
            })
            .then(response => {  
                if (!response.ok) {
                throw new Error('Network response was not ok');
                }
                return response.json();
            })
                .then(data => { data
                    if(data){
                        $('form')[0].reset();
                        $('img')[0].src="";
                        $('#Aauthors').html(`<option selected="">author</option>`);
                        $('#add-modal').modal('hide');
                        refresh();
                        $('#add-modal').modal('hide');
                        swal({
                            //  title: title,
                            text: "Add successfully",
                            content: true,
                            icon: "success",
                            classname: 'swal-IW',
                            timer: 1700,
                            buttons: false,
                        });
                    }
                })
                .catch(error => {
                    console.error('Error during fetch operation:', error);
                });
            })
            //#endregion

            //#region Edit
            const btnEdit = document.getElementById('btn-edit');
            btnEdit.addEventListener('click', function () {
                var formData = new FormData(document.getElementById('edit-form'));
                fetch('handel.php/posts/?id='+postId,  {
                method: 'POST',
                body: formData,
                })
                .then(response => {  
                if (!response.ok) {
                throw new Error('Network response was not ok');
                }
                return response.json();
                })
                .then(data => { data
                    if(data){
                        refresh();
                        $('form')[0].reset();
                        $('img')[0].src="";
                        $('#Eauthors').html("");
                        $('#e-modal').modal('hide');
                        $('#e-modal').modal('hide');
                    }
                })
                .catch(error => {
                    console.error('Error during fetch operation:', error);
                });
            })
            //#endregion
             
            //#region Delete
            const btnDelete = document.getElementById('btn-delete');
            btnDelete.addEventListener('click', function () {
                fetch('handel.php/posts/?id=' + postId, {
                    method: 'DELETE',
                })
                .then(response => {  
                    if (!response.ok) {
                    throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => { data
                        if(data){
                            refresh();
                            $('#d-modal').modal('hide');
                            swal({
                            //  title: title,
                            text: "Delete successfully",
                            content: true,
                            icon: "success",
                            classname: 'swal-IW',
                            timer: 1700,
                            buttons: false,
                        });
                        }
                })
                .catch(error => {
                    console.error('Error during fetch operation:', error);
                });
            })
            //#endregion
        });
    </script>
</body>
</html>