@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Points Management'))

@section('content')
    <div id="ui-view"><div><div class="fade-in">
                <div class="card">
                    <div class="card-header">
                        <div class="page_title"><i class="fas fa-user-friends page_title_icon"></i> Add Points</div>
                        <div class="float-right">
                        </div>
                    </div>
                    <div class="card-body">

                     <div class="row">
                         <div class="col-md-6">
                             <h3>{{$team01->display_name}}</h3>

                             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#team01PointsModal">
                              Add Points to team 01
                             </button>
                         </div>
                         <div class="col-md-6">
                             <h3>{{$team02->display_name}}</h3>
                             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#team02PointsModal">
                                 Add Points to team 02
                             </button>
                         </div>
                     </div>
                    </div>
                </div>
            </div></div>
    </div>

    <!--Team 01 points Modal -->
    <div class="modal fade" id="team01PointsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$team01->display_name}} Add Points</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{route('admin.operation.addPoints')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Trys</label>
                            <input type="number" class="form-control" id="trys" name="trys" placeholder="Trys" value="0" min = 0 max = 1>
                            <input type="hidden" class="form-control" id="team_id" name="team_id" placeholder="Trys" value="{{$team01->id}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Conversions</label>
                            <input type="number" min = 0 max = 1 class="form-control" id="conversions" name="conversions" placeholder="Conversions" value="0">
                        </div>


                        <button type="submit" class="btn btn-primary"><span class="cil-contrast btn-icon mr-2"></span>
                            Add
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!--Team 02 points Modal -->
    <div class="modal fade" id="team02PointsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$team02->display_name}} Add Points</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{route('admin.operation.addPoints')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Trys</label>
                            <input type="number" class="form-control" id="trys" name="trys" placeholder="Trys" value="0" min = 0 max = 1>
                            <input type="hidden" class="form-control" id="team_id" name="team_id" placeholder="Trys" value="{{$team02->id}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Conversions</label>
                            <input type="number"  min = 0 max = 1 class="form-control" id="conversions" name="conversions" placeholder="Conversions" value="0">
                        </div>


                        <button type="submit" class="btn btn-primary"><span class="cil-contrast btn-icon mr-2"></span>
                            Add
                        </button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
@endsection
