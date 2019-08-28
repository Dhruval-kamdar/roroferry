        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        
                        <div class="ibox-title">
                            <div class="row">
                                <form method="post" id="reportPdf" action="<?= base_url().'report-pdf' ?>"  enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="col-12 control-label">Date</label>
                                            <div class="col-12">
                                                <input type="text" name="date" id="startdate" placeholder="Enter route date" class="form-control" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="col-12 control-label">Route Name</label>
                                            <div class="col-12">
                                                <select name="route" id="route" class="route form-control">
                                                    <option value="">Select Route</option>
                                                    <?php for($i=0 ;$i < count($route) ; $i++){?>
                                                        <option value="<?= $route[$i]->id ?>"><?= $route[$i]->route ?></option>
                                                    <?php 
                                                    }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="col-12 control-label">Ferry Time</label>
                                            <div class="col-12">
                                                <select name="ferryTime" class="time1 form-control">
                                                    <option value="">Select Ferry Time</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="col-12 control-label">&nbsp;</label>
                                            <div class="col-12">
                                                <button class="col-12 btn btn-primary" type="submit">Get Report</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        
                        <div class="ibox-title">
                            <h5>Booking List</h5>
                        </div>
                        <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="passengerList" >
                                <thead>
                                    <tr>
                                        <th>No</th>   
                                        <th>PNR Number</th>
                                        <th>Seat No</th>
                                        <th>Route</th>
                                        <th>Trip Date</th>
                                        <th>Trip Time</th>
                                        <th>Pickup Time</th>
                                        <th>Pickup Station</th>
                                        <th>Drop Time</th>
                                        <th>Drop Station</th>
                                        <th>Phone Number</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th>Transaction Id</th>
                                    </tr>
                                </thead>
                                
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .has-error {
                border-color: red!important;
                border-width: 1px!important;
            }
            .arrow1{
                    margin: auto;
                        padding: 18px;
            }
        </style>