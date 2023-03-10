@include('Template.head')
@include('Template.sidebar')
<div class="content-wrapper">
 
    <div class="content-header">
      <div class="container-fluid">

        <div class="row mb-2">
            <div class="col-sm-12">
              <div class="container-xl">
                  <div class="table-responsive">
                      <div class="table-wrapper">
                          <div class="table-title">
                              <div class="row">
                                  <div class="col-sm-12">
                                      <h2>Manage <b>Reservasi</b></h2>
                                  </div>
                                  <div class="col-sm-12">
                                      <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><span>Reservasi Sekarang!</span></a>
                                      @if (auth()->user()->level=="admin")
                                      <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
                                    @endauth
                                    </div>
                              </div>
                          </div>
                          <table class="table table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th>
                                          <span class="custom-checkbox">
                                              <input type="checkbox" id="selectAll">
                                              <label for="selectAll"></label>
                                          </span>
                                      </th>
                                      <th>Nama</th>
                                      <th>Alamat</th>
                                      <th>No Telpon</th>
                                      <th>Nominal Booking</th>
                                      <th>Actions</th>
                                  </tr>
                             
        
                              </thead>
                              @foreach ($reservasi as $r )
                              <tbody>
                                  <tr>
                                      <td>
                                          <span class="custom-checkbox">
                                              <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                              <label for="checkbox1"></label>
                                          </span>
                                      </td>
                                      <td>{{$r->nama}}</td>
                                      <td>{{$r->alamat}}</td>
                                      <td>{{$r->notlp}}</td>
                                      <td>{{$r->nominal_booking}}</td>
                                      @if (auth()->user()->level=="admin")
                                      <td><a href="/reservasi/{{$r->id}}/edit"  class="btn btn-warning">Edit</a>
                                    </td>
                                      <td>
                                        <form action="/reservasi/{{$r->id}}" method="POST ">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger show_confirm">delete</button>
                                        </form>
        
                                      </td>
                                      @endauth
                                  </tr>
                                  </tr> 
                              </tbody>
                              @endforeach
                              
                          </table>
                          
                      </div>
                  </div>        
              </div>
          
        {{-- MEMASUKAN DATA --}}
        <div id="addEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/reservasi/store" method="POST">
                        @csrf 
                        <div class="modal-header">						
                            <h4 class="modal-title">Reservasi Sekarang!</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">					
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" name="alamat" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>No Telepon</label>
                                <input type="text" name="notlp" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Nominal</label>
                                <input type="text" name="nominal_booking" class="form-control" required>
                            </div>					
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-success" value="Save" name="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Edit Modal HTML -->
            <div id="editEmployeeModal"  class="modal fade">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <form accept="/reservasi/store" method="POST" >
                              <div class="modal-header">						
                                  <h4 class="modal-title">Edit Employee</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              </div>
                              <div class="modal-body">					
                                  <div class="form-group">
                                      <label>Nama</label>
                                      <input type="text" class="form-control" name="nama" required value="{{$r->snama}}">
                                  </div>
                                  <div class="form-group">
                                      <label>Alamat</label>
                                      <input type="text" class="form-control" name="alamat" required value="{{$r->alamat}}">
                                  </div>
                                  <div class="form-group">
                                      <label>No Telepon</label>
                                      <textarea type="text" class="form-control" name="notlp" required value="{{$r->notlp}}"></textarea>
                                  </div>
                                  <div class="form-group">
                                      <label>Nominal Booking</label>
                                      <input type="text" class="form-control" name="nominal_booking" required value="{{$r->nominal_booking}}"> 
                                  </div>					
                              </div>
                              <div class="modal-footer">
                                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                  <input type="submit" class="btn btn-info" value="Save">
                              </div>
                          </form>
                      </div>
                  </div>
              </div> 
              <!-- Delete Modal HTML -->
              -- <div id="deleteEmployeeModal" class="modal fade">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <form>
                              <div class="modal-header">						
                                  <h4 class="modal-title">Delete Employee</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              </div>
                              <div class="modal-body">					
                                  <p>Are you sure you want to delete these Records?</p>
                                  <p class="text-warning"><small>This action cannot be undone.</small></p>
                              </div>
                              <div class="modal-footer">
                                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                  <input type="submit" class="btn btn-danger" value="Delete">
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
       
      </div>
    </div>
  </div>
  
      



      <style>
          body {
              color: #566787;
              background: #f5f5f5;
              font-family: 'Varela Round', sans-serif;
              font-size: 13px;
          }
          .table-responsive {
              margin: 30px 0;
          }
          .table-wrapper {
              background: #fff;
              padding: 20px 25px;
              border-radius: 3px;
              min-width: 1000px;
              box-shadow: 0 1px 1px rgba(0,0,0,.05);
          }
          .table-title {        
              padding-bottom: 15px;
              background: #435d7d;
              color: #fff;
              padding: 16px 30px;
              min-width: 100%;
              margin: -20px -25px 10px;
              border-radius: 3px 3px 0 0;
          }
          .table-title h2 {
              margin: 5px 0 0;
              font-size: 24px;
          }
          .table-title .btn-group {
              float: right;
          }
          .table-title .btn {
              color: #fff;
              float: right;
              font-size: 13px;
              border: none;
              min-width: 50px;
              border-radius: 2px;
              border: none;
              outline: none !important;
              margin-left: 10px;
          }
          .table-title .btn i {
              float: left;
              font-size: 21px;
              margin-right: 5px;
          }
          .table-title .btn span {
              float: left;
              margin-top: 2px;
          }
          table.table tr th, table.table tr td {
              border-color: #e9e9e9;
              padding: 12px 15px;
              vertical-align: middle;
          }
          table.table tr th:first-child {
              width: 60px;
          }
          table.table tr th:last-child {
              width: 100px;
          }
          table.table-striped tbody tr:nth-of-type(odd) {
              background-color: #fcfcfc;
          }
          table.table-striped.table-hover tbody tr:hover {
              background: #f5f5f5;
          }
          table.table th i {
              font-size: 13px;
              margin: 0 5px;
              cursor: pointer;
          }	
          table.table td:last-child i {
              opacity: 0.9;
              font-size: 22px;
              margin: 0 5px;
          }
          table.table td a {
              font-weight: bold;
              color: #566787;
              display: inline-block;
              text-decoration: none;
              outline: none !important;
          }
          table.table td a:hover {
              color: #2196F3;
          }
          table.table td a.edit {
              color: #FFC107;
          }
          table.table td a.delete {
              color: #F44336;
          }
          table.table td i {
              font-size: 19px;
          }
          table.table .avatar {
              border-radius: 50%;
              vertical-align: middle;
              margin-right: 10px;
          }
          .pagination {
              float: right;
              margin: 0 0 5px;
          }
          .pagination li a {
              border: none;
              font-size: 13px;
              min-width: 30px;
              min-height: 30px;
              color: #999;
              margin: 0 2px;
              line-height: 30px;
              border-radius: 2px !important;
              text-align: center;
              padding: 0 6px;
          }
          .pagination li a:hover {
              color: #666;
          }	
          .pagination li.active a, .pagination li.active a.page-link {
              background: #03A9F4;
          }
          .pagination li.active a:hover {        
              background: #0397d6;
          }
          .pagination li.disabled i {
              color: #ccc;
          }
          .pagination li i {
              font-size: 16px;
              padding-top: 6px
          }
          .hint-text {
              float: left;
              margin-top: 10px;
              font-size: 13px;
          }    
          /* Custom checkbox */
          .custom-checkbox {
              position: relative;
          }
          .custom-checkbox input[type="checkbox"] {    
              opacity: 0;
              position: absolute;
              margin: 5px 0 0 3px;
              z-index: 9;
          }
          .custom-checkbox label:before{
              width: 18px;
              height: 18px;
          }
          .custom-checkbox label:before {
              content: '';
              margin-right: 10px;
              display: inline-block;
              vertical-align: text-top;
              background: white;
              border: 1px solid #bbb;
              border-radius: 2px;
              box-sizing: border-box;
              z-index: 2;
          }
          .custom-checkbox input[type="checkbox"]:checked + label:after {
              content: '';
              position: absolute;
              left: 6px;
              top: 3px;
              width: 6px;
              height: 11px;
              border: solid #000;
              border-width: 0 3px 3px 0;
              transform: inherit;
              z-index: 3;
              transform: rotateZ(45deg);
          }
          .custom-checkbox input[type="checkbox"]:checked + label:before {
              border-color: #03A9F4;
              background: #03A9F4;
          }
          .custom-checkbox input[type="checkbox"]:checked + label:after {
              border-color: #fff;
          }
          .custom-checkbox input[type="checkbox"]:disabled + label:before {
              color: #b8b8b8;
              cursor: auto;
              box-shadow: none;
              background: #ddd;
          }
          /* Modal styles */
          .modal .modal-dialog {
              max-width: 400px;
          }
          .modal .modal-header, .modal .modal-body, .modal .modal-footer {
              padding: 20px 30px;
          }
          .modal .modal-content {
              border-radius: 3px;
              font-size: 14px;
          }
          .modal .modal-footer {
              background: #ecf0f1;
              border-radius: 0 0 3px 3px;
          }
          .modal .modal-title {
              display: inline-block;
          }
          .modal .form-control {
              border-radius: 2px;
              box-shadow: none;
              border-color: #dddddd;
          }
          .modal textarea.form-control {
              resize: vertical;
          }
          .modal .btn {
              border-radius: 2px;
              min-width: 100px;
          }	
          .modal form label {
              font-weight: normal;
          }	
          </style>
      
    </div>
   
  </div>