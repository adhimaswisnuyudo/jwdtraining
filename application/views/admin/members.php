<?php include HEADERLAYOUT; ?>
                <div class="container-fluid">
<!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=$title;?></h1>
                    <p class="mb-4"><?=$subtitle;?></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <button class="btn btn-primary" onclick="setmodal('add')"><i class="fa fa-plus"></i> Tambah</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tblmembers" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>NIK</th>
                                            <th>Telp</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 0;
                                            foreach($members as $m){
                                            $no++ 
                                        ?>
                                        <tr>
                                            <td><?=$no;?></td>
                                            <td><?=$m->name;?></td>
                                            <td><?=$m->identitynumber;?></td>
                                            <td><?=$m->phone;?></td>
                                            <td><?=$m->address;?></td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" onclick="edit('<?=$m->memberid;?>','<?=$m->name;?>','<?=$m->identitynumber;?>','<?=$m->phone;?>','<?=$m->address;?>',)"><i class="fa fa-edit"></i> Edit</button>
                                                <button class="btn btn-danger btn-sm" onclick="deletemember('<?=$m->memberid;?>')"><i class="fa fa-trash"></i> Delete</button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal fade bd-example-modal-lg" id="modalmember" role="dialog" aria-labelledby="" aria-hidden="true">
                    <form id="formmember">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modaltitle"></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="hidden" name="mode" id="mode">
                                        <input type="hidden" name="memberid" id="memberid">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Nama Lengkap">
                                    </div>
                                    <div class="form-group">
                                        <label>NIK</label>
                                        <input type="number" class="form-control" name="identitynumber" id="identitynumber" placeholder="Nomor Induk Kependudukan">
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Hp</label>
                                        <input type="text" class="form-control" name="phone" id="phone">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Lengkap</label>
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Alamat Lengkap">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" id="btnsubmit" name="btnsubmit"></button>
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <script src="<?=base_url('assets/');?>vendor/datatables/jquery.dataTables.min.js"></script>
                <script src="<?=base_url('assets/');?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#tblmembers').DataTable();
                    });

                    function setmodal(mode){
                        $("#modalmember").modal('show');
                        if(mode=="add"){
                            $("#memberid").val("");
                            $("#name").val("");
                            $("#identitynumber").val("");
                            $("#phone").val("");
                            $("#address").val("");
                            $("#mode").val("add");
                            $("#modaltitle").html("Tambah Data");
                            $("#btnsubmit").html("<i class='fa fa-save'></i> Simpan");
                        }
                        else if(mode=="edit"){
                            $("#mode").val("edit");
                            $("#btnsubmit").html("<i class='fa fa-edit'></i> Perbaharui");
                        }
                        else{
                            alert('terjadi kesalahan');
                        }
                    }

                    function edit(memberid,name,identitynumber,phone,address){
                        $("#memberid").val(memberid);
                        $("#name").val(name);
                        $("#identitynumber").val(identitynumber);
                        $("#phone").val(phone);
                        $("#address").val(address);
                        $("#modaltitle").html("Perbaharui Data "+name);
                        setmodal("edit");
                    }

                    $("#formmember").on("submit",function(e){
                        e.preventDefault();
                        var url = "<?=base_url('addorupdatemember')?>";
                        $.ajax({
                            url:url,
                            type:'POST',
                            data:new FormData(this),
                            processData:false,
                            contentType:false,
                            success : function(response){
                                console.log(response);
                                if(response.status=="success"){
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.status,
                                        text: response.message,
                                    });
                                }
                                else{
                                    Swal.fire({
                                        icon: 'error',
                                        title: response.status,
                                        text: response.message,
                                    });
                                }
                            },
                            error : function(response){
                                alert('MAAF HTTP RESPONSE ERROR !');
                            }
                        });
                        return false;
                    });

                    function deletemember(memberid){
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                            if (result.isConfirmed) {
                                var url = "<?=base_url('deletemember')?>";
                                var mydata = {<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>','memberid':memberid};
                                $.ajax({
                                    url:url,
                                    type:'POST',
                                    data:mydata,
                                    success : function(response){
                                        console.log(response);
                                        if(response.status=="success"){
                                            Swal.fire({
                                                icon: 'success',
                                                title: response.status,
                                                text: response.message,
                                            });
                                            location.reload();
                                        }
                                        else{
                                            Swal.fire({
                                                icon: 'error',
                                                title: response.status,
                                                text: response.message,
                                            });
                                        }
                                    },
                                    error : function(response){
                                        alert('MAAF HTTP RESPONSE ERROR !');
                                    }
                                }); 
                            }
                            })
                    }
                </script>
<?php include FOOTERLAYOUT; ?>