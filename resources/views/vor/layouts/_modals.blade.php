
        {{-- Logout Modal End --}}

        <div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {{-- <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Static backdrop</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> --}}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <h4><span class="ri-logout-circle-line align-middle me-5 text-danger" style="font-size: 40px;"></span> Logout?</h4>
                            </div>
                            <div class="col-md-3"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 p-3">
                                <p>Are you sure you want to logout?</p>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0);" class="btn btn-light waves-effect" data-bs-dismiss="modal">No</a>
                        <a href="{{ url('logout') }}" class="btn btn-primary waves-effect waves-light">Yes</a>
                    </div>
                </div>
            </div>
        </div>


        {{-- Logout Modal End --}}




        <!-- User Details Modal Start -->
        <div class="bootstrap-modal">
            <div class="modal fade songdetail" tabindex="-1" role="dialog" id="mysongdetail" aria-labelledby="mysongdetail" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title header_artiste" id="mysongdetail">Add Admin User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        
                            <div class="col-12">
                                {{-- <img src="{{ url('public/vor/songimg/Crazy by MOG.jpg')}}" alt="" style=""> --}}

                                <div class="card">
                                    <div class="top_artiste_image"></div>
                                    {{-- <img class="card-img-top img-fluid top_artiste_image" src="{{ url('public/vor/songimg/Crazy by MOG.jpg')}}" alt="Card image cap"> --}}
                                    <div class="card-body">
                                        <h4 id="artiste_name">Card title</h3>
                                        <h4 id="song_title">Card title</h3>
                                    </div>
                                    {{-- <hr> --}}
                                    <ul class="list-group list-group-flush">
                                        <li id="song_downloads" class="list-group-item">Cras justo odio</li>
                                        <li id="song_category" class="list-group-item">Dapibus ac facilisis in</li>
                                    </ul>

                                    <ul class="list-group list-group-flush">
                                        <li id="song_genre" class="list-group-item">Cras justo odio</li>
                                        <li id="song_album" class="list-group-item">Dapibus ac facilisis in</li>
                                    </ul>

                                    <div class="card-body">
                                        <h4>Lyrics</h4>
                                        <textarea  wrap='off' disabled id="song_lyrics" class="col-12 form-class" rows="10" style="border: none; cursor: auto;"></textarea>
                                        {{-- <textarea id="song_lyrics"></div> --}}
                                    </div>

                                    <div class="row mx-2">
                                        <div class="col-md-6">Date Created</div>
                                        <div class="col-md-6">Last Updated</div>
                                    </div>
                                    <div class="card-body">
                                        <a href="#" id="song_created_at" class="card-link">Card link</a>
                                        <a href="#" id="song_updated_at" class="card-link">Another link</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>
        </div>
        
        <!-- User Detail Modal End -->


        
        <!-- Admin Image Edit Start -->
        <div id="editImageFormModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ url('admin/user/update_image')}}" class="form-group" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="edit_photo_id">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Update Admin Image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row"></div>

                            <div class="row my-4">
                                <div class="col-md-12">
                                    <h5 id="user_name_resp"></h5>  
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="user_file" class="form-label">Choose File</label>
                                    
                                    <input name="user_image_file" type="file"  class="form-control" id="user_file">
                                       
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Update Image</button>
                        </div>
                    </div><!-- /.modal-content -->
                </form>
            </div><!-- /.modal-dialog -->
        </div>
        <!-- Admin Image Edit End -->




        <!-- First Timer Details Modal Start -->
        <div class="bootstrap-modal">
            <div class="modal fade adminftdetail" tabindex="-1" role="dialog" id="myadminftdetail" aria-labelledby="myadminftdetail" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myadminftdetail">Detail Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="row  mb-lg-5 mb-lg-5">
                                    <div class="col-9">
                                        <div class="md-2">
                                            <div class="row">
                                                <div class="col-3">Full Name: </div>
                                                <div class="col-5 text-dark" id="ft_text_name"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">Email: </div>
                                                <div class="col-5 text-dark" id="ft_text_email"></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-3">Phone: </div>
                                                <div class="col-5 text-dark" id="ft_text_phone"></div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-3">Registered By: </div>
                                                <div class="col-5 text-dark" id="ft_text_registered_by"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <hr>
                                </div>

                                <div class="row mb-lg-3">
                                    <div class="col-6">
                                        <div>FIRST TIMER INTEREST</div>
                                        <p id="ft_text_ft_interest" class="text-dark"></p>
                                    </div>
                                    <div class="col-6">
                                        <div>FULL NAME</div>
                                        <p id="ft_text_name2" class="text-dark"></p>
                                    </div>
                                </div>
            
                                <div class="row mb-lg-3">
                                    <div class="col-6">
                                        <div>FIRST TIMER BRANCH</div>
                                        <p id="ft_text_branch_name" class="text-dark"></p>
                                    </div>
                                    <div class="col-6">
                                        <div>RESIDENTIAL ADDRESS</div>
                                        <p id="ft_text_ft_location" class="text-dark"></p>
                                    </div>
                                </div>

                                <div class="row mb-lg-3">
                                    <div class="col-6">
                                        <div>GENDER</div>
                                        <p id="ft_text_gender" class="text-dark"></p>
                                    </div>
                                    <div class="col-6">
                                        <div >PHONE</div>
                                        <p id="ft_text_phone2" class="text-dark"></p>
                                    </div>
                                </div>
                                
                                <div class="row mb-lg-3">
                                    <div class="col-6">
                                        <div>RECEIVED JESUS CHRIST?</div>
                                        <p id="text_ft_accept_jesus" class="text-dark"></p>
                                    </div>
                                    <div class="col-6">
                                        <div>RECEIVED THE HOLY SPIRIT?</div>
                                        <p id="text_ft_rec_holy" class="text-dark"></p>
                                    </div>
                                </div>

                                <div class="row mb-lg-3">
                                    <div class="col-6">
                                        <div>DATE CREATED FIRST TIMER</div>
                                        <p id="ft_text_date_created" class="text-dark"></p>
                                    </div>
                                    <div class="col-6">
                                        <div>DATE FIRST TIMER UPDATED</div>
                                        <p id="ft_text_date_updated" class="text-dark"></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>
        </div>
        <!-- User Detail Modal End -->

        

        

        <!-- Member Details Modal Start -->
        <div class="bootstrap-modal">
            <div class="modal fade adminMemberDetail" tabindex="-1" role="dialog" id="myadminMemberDetail" aria-labelledby="myadminMemberDetail" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myadminMemberDetail">Member Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <h4 class="card-title">Member Details Information</h4>
                            <div class="col-xl-12">
                                <div class="card p-4">
                                    <div class="card-body">
                                        <div class="row  mb-lg-5 mb-lg-5">
                                            <div class="col-9">
                                                <div class="md-2">
                                                    <div class="row">
                                                        <div class="col-3">Full Name: </div>
                                                        <div class="col-5 text-dark" id="member_text_name"></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-3">Email: </div>
                                                        <div class="col-5 text-dark" id="member_text_email"></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-3">Phone: </div>
                                                        <div class="col-5 text-dark" id="member_text_phone"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="md-2">
                                                    <div id="a_member_img_src"></div>
                                                        <div id="member_img_tag_name">
                                                            
                                                        </div>
                                                    <!-- </a> -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <hr>
                                        </div>
                                        
                                        
                                        <div class="row mb-lg-3">
                                            <div class="col-6">
                                                <div>E-MAIL VERIFICATION</div>
                                                <p id="member_text_verified" class="text-dark"></p>
                                            </div>
                                            <div class="col-6">
                                                <div>MEMBER ID</div>
                                                <p id="text_mem_id" class="text-dark"></p>
                                            </div>
                                        </div>

                                        <div class="row mb-lg-3">
                                            <div class="col-6">
                                                <div>NATIONALITY</div>
                                                <p id="text_nationality" class="text-dark"></p>
                                            </div>
                                            <div class="col-6">
                                                <div>REGION</div>
                                                <p id="text_region_name" class="text-dark"></p>
                                            </div>
                                        </div>

                                        <div class="row mb-lg-3">
                                            <div class="col-6">
                                                <div>USER CODE</div>
                                                <p id="text_member_code" class="text-dark"></p>
                                            </div>
                                            <div class="col-6">
                                                <div>RESIDENTIAL ADDRESS</div>
                                                <p id="text_location" class="text-dark"></p>
                                            </div>
                                        </div>

                                        <div class="row mb-lg-3">
                                            <div class="col-6">
                                                <div>GENDER</div>
                                                <p id="member_text_gender" class="text-dark"></p>
                                            </div>
                                            <div class="col-6">
                                                <div >PHONE</div>
                                                <p id="member_text_phone2" class="text-dark"></p>
                                            </div>
                                        </div>

                                        <div class="row mb-lg-3">
                                            <div class="col-6">
                                                <div>CHAPTER NAME</div>
                                                <p id="member_text_chapter" class="text-dark"></p>
                                            </div>
                                            <div class="col-6">
                                                <div>MEMBER STATUS</div>
                                                <p id="text_member_state" class="text-dark"></p>
                                            </div>
                                        </div>

                                        
                                        <div class="row mb-lg-3">
                                            <div class="col-6">
                                                <div>RECEIVED JESUS CHRIST?</div>
                                                <p id="text_accept_jesus" class="text-dark"></p>
                                            </div>
                                            <div class="col-6">
                                                <div>RECEIVED THE HOLY SPIRIT?</div>
                                                <p id="text_holy_spirit" class="text-dark"></p>
                                            </div>
                                        </div>

                                        <div class="row mb-lg-3">
                                            <div class="col-6">
                                                <div>BIRTH DATE</div>
                                                <p id="text_birth_date" class="text-dark"></p>
                                            </div>
                                            <div class="col-6">
                                                <div>GPS ADDRESS</div>
                                                <p id="text_gps" class="text-dark"></p>
                                            </div>
                                        </div>

                                        <div class="row mb-lg-3">
                                            <div class="col-6">
                                                <div>BAPTIZED?</div>
                                                <p id="text_baptized" class="text-dark"></p>
                                            </div>
                                            <div class="col-6">
                                                <div>DATE BAPTIZED</div>
                                                <p id="text_date_bap" class="text-dark"></p>
                                            </div>
                                        </div>
                                    
                                        <div class="row mb-lg-3">
                                            <div class="col-6">
                                                <div>DATE CREATED MEMBER</div>
                                                <p id="member_text_date_created"></p>
                                            </div>
                                            <div class="col-6">
                                                <div>DATE MEMBER UPDATED</div>
                                                <p id="member_text_date_updated" class="text-dark"></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>
        </div>
       <!-- Member Detail Modal End -->




        <!-- Admin Image Edit Start -->
        <div id="editMemberImageFormModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ url('admin/member/update_image')}}" class="form-group" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="edit_member_photo_id">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Update Member Image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row"></div>

                            <div class="row my-4">
                                <div class="col-md-12">
                                    <h5 id="member_name_resp"></h5>  
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="member_file" class="form-label">Choose File</label>
                                    
                                    <input name="member_image_file" type="file"  class="form-control" id="member_file">
                                        
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Update Image</button>
                        </div>
                    </div><!-- /.modal-content -->
                </form>
            </div><!-- /.modal-dialog -->
        </div>
        <!-- Admin Image Edit End -->

