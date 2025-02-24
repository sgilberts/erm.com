
        <table id="alternative-page-datatable" class="table dt-responsive nowrap w-100 datatables"  data-page-length="5">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Member ID</th>
                    <th>Status</th>
                    <th>Birth Date</th>
                </tr>
            </thead>
            <tbody>
                    
            @foreach ($getNewBD as $row) 

                @php
                
                    $infos = $row->getCalcBirthdayNoti($row->bdate); 
               
                @endphp    
            <tr>
                <td>{{ $row->id }}</td>    
                <td><h6 class="mb-0">{{ $row->first_name.' '.$row->last_name }}</h6></td>

                <td>
                    <div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-{{ $infos['btn_color'] }} align-middle me-2"></i>{{ $row->mem_id }}</div>
                </td>
                <td>

                    {{-- getCalcBirthdayNoti --}}

                    
                    <span class="badge bg-{{ $infos['btn_color'] }}">{{ $infos['text_info_status'] }} </span> 
                        @if ( $infos['btn_color'] == 'success')
                            <span class="spinner-grow text-{{ $infos['btn_color'] }} m-1" role="status"></span>
                        @endif
                    
                </td>
                <td>
                    {{ date( 'd M ', strtotime( $row->bdate)) }}
                </td>
            </tr>

            @endforeach
            
        
             <!-- end -->
        </tbody>
    </table> 

