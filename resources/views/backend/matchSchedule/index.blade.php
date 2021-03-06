@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Match Management'))

@section('content')
    <div id="ui-view"><div><div class="fade-in">
                <div class="card">
                    <div class="card-header">
                        <div class="page_title"><i class="fas fa-user-friends page_title_icon"></i> Match Schedules</div>
                        <div class="float-right">
{{--                         <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#createTournamentModel">--}}
{{--                               Create Match Schedules--}}
{{--                            </button>--}}
                        </div>
                    </div>
                    <div class="card-body table-responsive">

                        <table class="uk-table uk-table-hover uk-table-striped" style="font-size:11.5px;width: 100%"  id="match_datatable">
                            <thead>
                            <tr>
                                <th>Tournament</th>
                                <th>Team 01</th>
                                <th>Team 02</th>
                                <th>Add Points</th>

                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div></div>
    </div>

    <!--Create Tournament Modal -->
{{--    <div class="modal fade" id="createTournamentModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="exampleModalLongTitle">Create Tournament</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <form  method="POST" action="{{route('admin.tournament.store')}}" enctype="multipart/form-data">--}}
{{--                        @csrf--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="exampleFormControlInput1">Display Name<span style="color: red">*</span> </label>--}}
{{--                            <input type="text" class="form-control" id="display_name" name="display_name" placeholder="Display Name" required>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="exampleFormControlInput1">Logo<span style="color: red">*</span></label>--}}
{{--                            <input type="file" class="form-control" id="logo" name="logo" required>--}}
{{--                        </div>--}}

{{--                        <button type="submit" class="btn btn-primary"><span class="cil-contrast btn-icon mr-2"></span>--}}
{{--                         Create--}}
{{--                        </button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{-- DATATABLE SCRIPT FOR MATCHES --}}
    <script>
        $(document).ready( function () {
            var table = $('#match_datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: "{!! route('admin.operation.getData_matchSchedule') !!}",
                columns: [
                    { data: 'tournament' },
                    { data: 'team_1' },
                    { data: 'team_2' },
                    { data: 'action' }
                ],
                pageLength:50,
                lengthMenu:[[10,25,50,100,500,-1],[10,25,50,100,500,"All"]],
            });
        });
    </script>

@endsection
