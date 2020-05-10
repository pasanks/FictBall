@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Team Management'))

@section('content')
    <div id="ui-view"><div><div class="fade-in">
                <div class="card">
                    <div class="card-header">
                        <div class="page_title"><i class="fas fa-user-friends page_title_icon"></i>  Register A Team</div>
                        <div class="float-right">
                         <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#createTeamModel">
                               Register A Team
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">

                        <table class="uk-table uk-table-hover uk-table-striped" style="font-size:11.5px;width: 100%"  id="team_datatable">
                            <thead>
                            <tr>
                                <th>Tournament</th>
                                <th>Team Name</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div></div>
    </div>

    <!--Create Team Modal -->
    <div class="modal fade" id="createTeamModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Register A Team</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{route('admin.reg_team.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tournament<span style="color: red">*</span> </label>
                            <select class="form-control" name="tournament_id" id="tournament_id" required>
                                <option value="">Select A tournament</option>
                                @foreach($tournaments as $value)
                                    <option value="{{$value->id}}">{{$value->display_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Team Display Name<span style="color: red">*</span> </label>
                            <input type="text" class="form-control" id="display_name" name="display_name" placeholder="Display Name" required>
                        </div>
                        <button type="submit" class="btn btn-primary"><span class="cil-contrast btn-icon mr-2"></span>
                         Register
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

{{-- DATATABLE SCRIPT FOR TOURNAMENTS --}}
    <script>
        $(document).ready( function () {
            var table = $('#team_datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: "{!! route('admin.reg_team.getData_teams') !!}",
                columns: [
                    { data: 'tournament' },
                    { data: 'display_name' },
                    { data: 'created_at' }
                ],
                pageLength:50,
                lengthMenu:[[10,25,50,100,500,-1],[10,25,50,100,500,"All"]],
            });
        });
    </script>

@endsection
