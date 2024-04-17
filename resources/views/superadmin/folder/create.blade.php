@extends('layouts.superadmin.app')
@section('content')
<div class="content-wrapper">
         
          <div class="d-sm-flex align-items-center justify-content-between border-bottom">
          </div>
          <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="content">
              
              <div class="card mt-5">
                  
                  <div class="card-header">
                    <p class="mt-2" style="font-size: 14pt;">Tambah Folder</p>
                   
                  </div>
                  <div class="card-body">
                      <form name="saveform" action="{{route('superadmin.folder.simpan')}}" method="post" onsubmit="return validateForm()">
                           @csrf
                          
                           <label for="" class="form-label"style="font-size: 11pt; font-weight: bold;">Pilih Group</label>
                           
<div class="form-group mb-4">
@foreach ($usergroup as $key => $item)
        @if ($key % 10 == 0 && $key != 0)
            </div><div class="form-group mb-4">
        @endif
        <div class="form-check" style="display: inline-block; margin-right: 10px;">
            <input class="form-check-input" name="group[]" type="checkbox" value="{{ $item->id }}" id="flexCheckIndeterminate{{ $key }}">
            <label class="form-check-label" style="margin-left: 5px;" for="flexCheckIndeterminate{{ $key }}">
            <a href="" class="detail-member" data-toggle="modal" data-target="#exampleModal" data-group-id="{{ $item->id }}">
    {{ $item->nama_group }} 
</a>

            </label>
        </div>

        <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail  Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
    @endforeach
</div>

                           <div class="form-group mb-4">
                               <label for="" class="form-label"style="font-size: 11pt; font-weight: bold;">Nama Folder</label>
                               <input name="nama_folder" type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" style="border-color: #01004C;" value=""  />
                               <!-- @if ($errors->has('name'))
                                   <p class="text-danger">{{$errors->first('name')}}</p>
                               @endif -->
                           </div>
                      
                           
                           <div class="form-group mb-4">
                               <button type="submit" class="btn " style="width:80px; height: 30px; background-color: #01004C; color: white; font-size: 12px;">Save</button>
                           </div>
                       </form>
                   </div>
                </div>

            </div>

        </div>
        
  
    
  </div>

 
  <script>
$(document).ready(function() {
    $('.detail-member').click(function(e) {
        e.preventDefault();
        var groupId = $(this).attr('data-group-id');
        $.ajax({
            url: '/group/' + groupId + '/members',
            type: 'GET',
            success: function(response) {
                // Bersihkan konten modal sebelum menambahkan data baru
                $('.modal-body').empty();
                // Tambahkan data anggota grup ke dalam modal
                $.each(response, function(index, member) {
                    $('.modal-body').append('<li>' + member.user.nama_user + '</li>');
                });
                // Tampilkan modal
             
            },
          
        });
    });
   
});



function validateForm() {
    var checkboxes = document.getElementsByName("group[]");
    var folderName = document.forms["saveform"]["nama_folder"].value;

    // Memeriksa apakah setidaknya satu checkbox terpilih
    var isChecked = false;
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            isChecked = true;
            break;
        }
    }

    if (!isChecked) {
        alert("Pilih setidaknya satu grup, jika tidak ada grup silakan buat grup terlebih dahulu.");
        return false;
    }

    // Memeriksa apakah nama folder diisi
    if (folderName == "") {
        alert("Nama folder harus diisi.");
        return false;
    }

    return true;
}
</script>
@endsection