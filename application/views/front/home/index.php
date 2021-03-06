<style>
    select.error{
        border: 1px solid #e80c0c;
    }
    input.error{
        border: 1px solid #e80c0c !important;
    }
    label.error {
        text-transform: none;
        font-size: 14px;
        color: #e80c0c;
        border: none;
    }
    span.error {
        text-transform: none;
        font-size: 14px;
        color: #e80c0c;
        border: none;
    }
    .title{
        margin-top: 20px !important; 
        text-align: center;
        font-size: 24px;
        text-transform: uppercase;
        font-weight: 900;
        color: #ffffff;
    }
    .subtitle{
        margin-top: 0px;
        text-align: center;
        font-size: 20px;
        text-transform: uppercase;
        font-weight: 800;
        color: #ffffff;
    }
</style>
<section class="banner navbar-static-top" id="top" style="background: #1f3646">
    <div class="container" >
        <div class="row" >
            <div class="col-md-12" >
                <div class="section-heading">
                    <p class="title">Mahavir Tours And Travels </p>
                    <p class="subtitle">Authorised booking Agent of DGSEA CONNECT PVT LTD </p>
                    
                </div>
                <div class="right-side" style="float: right !important;padding-bottom: 20px">
                        <div class="primary-button">
                            <a href="<?= base_url() . 'pay-now' ?>">Pay Now</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
<section class="banner" >
    <div class="container">
        <div class="row">
            
            <div class="col-md-12" style="margin: 0px;padding: 0px !important">
                <?php if (($this->session->flashdata('success'))) { ?>
                    <div class="alert alert-success">
                        <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>.
                    </div>
                <?php } ?>
                <section id="first-tab-group" class="tabgroup">
                    <form method='post' action='<?= base_url() . 'payment'; ?>' id='bookticket'>
                        <div id="tab1">
                            <!--Step 1-->

                            <div class="submit-form form1 ">
                                <h4>Trip Selection:</h4>

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="col-md-6">
                                            <div class="radio-select">
                                                <div class="row">
                                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                                        <label for="oneway">Without vehicle</label>
                                                        <input type="radio" class="tripFerrySelection" name="trip_type" id="withoutcargo" value="Without vehicle" checked='checked'>
                                                    </div>

                                                    <div class="col-md-5 col-sm-5 col-xs-5">
                                                        <label for="round">With vehicle</label>
                                                        <input type="radio" class="tripFerrySelection" name="trip_type" id="cargo" value="With vehicle" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">From :</label>
                                                <select name="fromstaton" class="tripFrom fromstaton">
                                                    <option value="">Select a location...</option>
                                                    <?php for ($i = 0; $i < count($getStop); $i++) { ?>
                                                        <option value="<?php echo $getStop[$i]['stationID']; ?>"><?php echo $getStop[$i]['stationName']; ?></option>
                                                    <?php } ?>

                                                </select>
                                                <label for="fromstaton" class="error"></label>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="to">To :</label>
                                                <select name="tostation" class="tripTo tostation">
                                                    <option value="">Select a location...</option>
                                                </select>
                                                <label for="tostation" class="error"></label>
                                            </fieldset>
                                        </div> 
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="departure">Trip Date :</label>
                                                <input name="depature" type="text" class="form-control date onewayTrip" id="deparure" placeholder="Select date..." autocomplete="off">
                                                <label for="depature" class="error"></label>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 returnTripDate hidden" id="returnTripDate">
                                            <fieldset>
                                                <label for="return">Return Trip Date :</label>
                                                <input name="returntrip" type="text" class="form-control date roundTrip" id="return" placeholder="Select date..." autocomplete="off">
                                                <label for="returntrip" class="error"></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset>
                                            <!--<button type="submit" id="form-submit" class="btn">Order Ticket Now</button>-->
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset>
                                            <button type="button" data-next-form='3' id="pageOne form-submit" class="pageOne btn nextbtn">Next</button>
                                        </fieldset>
                                    </div>
                                </div>

                            </div>

                            <!--Step 2 With vehicle-->
                            <div class="submit-form form2 hidden">
                                <center>
                                    <h4>With Vehicle trip Details</h4>
                                </center>
                                <!-- Label Div -->
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Route :&nbsp;<span class="ferryRouteText"></span></label>
                                            </fieldset>
                                        </div>


                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Type :&nbsp;<span class="ferryTypeText"></span></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Date :&nbsp;<span class="ferryDateText"></span></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>

                                <!-- Input Div -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="vehical">Vehicle:</label>
                                                <select class="vehical"  name="vehical" >
                                                    <option value="">Select a Vehicle...</option>
                                                    <?php for ($i = 0; $i < count($getVehical); $i++) { ?>
                                                        <option data-vehicleCategoryID="<?= $getVehical[$i]['vehicleCategoryID']; ?>" data-passanger="<?= $getVehical[$i]['maximumPassenger']; ?>" value="<?= $getVehical[$i]['vehicleTypeID']; ?>"><?= $getVehical[$i]['vehicleCategoryName']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="vehical" class="error"></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <!-- Button Div -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <button type="button" id="form-submit" data-prev-form='1' class="btn prevbtn">Prev</button>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset>
                                                <button type="button" id="form-submit" data-next-form='4' class="btn nextbtn">Next</button>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Step 3 Without vehicle-->
                            <div class="submit-form form3 hidden">
                                <center>
                                    <h4>Without Vehicle trip Details</h4>
                                </center>
                                <!-- Label Div -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Route :&nbsp;<span class="ferryRouteText"></span></label>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Type :&nbsp;<span class="ferryTypeText"></span></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Date :&nbsp;<span class="ferryDateText"></span></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>

                                <!-- Input Div -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr style="border-top: 1px solid #dbdada;">
                                        <p>
                                            Note: Bus service is additional service for our valued customers. Bus fare is not included in the ferry ticket booking and the same has to be paid during bus journey. To know more information about bus schedule and pricing, Click Here.
                                        </p> 
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <center>
                                                <p style="color: red"><b>Currently  bus service isn't available sorry for inconvenience.</b></p>
                                            </center>
                                        </div>
                                        <!--<div class="col-md-9">-->
                                        <div class="radio-select">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <label for="busservices">Avail Bus Services</label>
                                                    <input type="radio" class="busservices" name="pickupservices" id="busservices" value="Bus Services"  disabled>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <label for="transportation">Self-Transportation</label>
                                                    <input type="radio" class="busservices" name="pickupservices" id="transportation" value="Self Services" checked="checked" >
                                                </div>
                                            </div>
                                        </div>
                                        <!--</div>-->

                                    </div>
                                    <div class="bussationDiv hidden">
                                        <div class="col-md-6 ">
                                            <fieldset>
                                                <label for="pickpoint">Bus Route:</label>
                                                <select  class="busRoute" id="busRouteForBus" name="busRoute" class="busRoute" >
                                                    <option value="">Select Bus Route...</option>
                                                    <?php for ($i = 0; $i < count($route); $i++) { ?>
                                                        <option value="<?= $route[$i]->id; ?>"><?= $route[$i]->route; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="busRoute" class="error"></label>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="tripTime">Trip Time:</label>
                                                <select  class="tripTime" id="tripTimeForBus" name="tripTime"  >
                                                    <option value="">Select a trip time...</option>
                                                </select>
                                                <label for="tripTime" class="error"></label>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="tripPickUpTime">Trip PickUp station name - Time:</label>
                                                <select  class="tripPickUpTime" id="tripPickUpTimeForBus"  name="tripPickUpTime" class="tripPickUpTime" >
                                                    <option value="">Select a trip pickup station name - Time...</option>
                                                </select>
                                                <label for="tripPickUpTime" class="error"></label>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="tripDropTime">Trip drop station name - Time:</label>
                                                <select  class="tripDropTime"  id="tripDropTimeForBus"name="tripDropTime"  >
                                                    <option value="">Select a trip drop station name - Time...</option>
                                                </select>
                                                <label for="tripDropTime" class="error"></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <hr style="border-top: 1px solid #dbdada;">
                                        <p>
                                            Please note you have not avail bus service. ISPL is not responsible for your transportation arrangements from/to terminals.
                                        </p> 
                                    </div>
                                </div>

                                <!-- Button Div -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <button type="button" id="form-submit" data-prev-form='1' class="btn prevbtn">Prev</button>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset>
                                                <button type="button" id="form-submit" data-next-form='4' class="btn nextbtn">Next</button>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!--Step 4-->
                            <div class="submit-form form4 hidden">
                                <center>
                                    <h4>Trip Details</h4>
                                    <b><p class="bookingerror" style="color:red"></p></b>
                                </center>
                                <!-- Label Div -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Route :&nbsp;<span class="ferryRouteText"></span></label>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Type :&nbsp;<span class="ferryTypeText"></span></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Date :&nbsp;<span class="ferryDateText"></span></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-md-12 noofseat">
                                        <div class="col-md-12">
                                            <fieldset>
                                                <label style="color:red" for="from">Number of seat remaining :&nbsp;<span class="numberOfSeatRemainingText"></span></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="ferryTime">Ferry time :</label>
                                                <select class="ferryTime"  name="ferryTime" >
                                                    <option tripid=""  value="">Select a ferry time...</option>

                                                </select>
                                                <label for="ferryTime" class="error"></label>
                                            </fieldset>

                                            <fieldset >
                                                <label for="ferryClass">Ferry Class :</label>
                                                <select class="ferryClass"  name="ferryClass" >
                                                    <option value="">Select a ferry class...</option>
                                                </select>
                                                <label for="ferryClass" class="error"></label>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">

                                            <fieldset class="noPassangerDiv hidden">
                                                <label for="noPassanger">Number of passenger :</label>
                                                <select class="noPassanger" id="noPassanger" name="noPassanger" >
                                                    <option value="">Select a number of passenger...</option>
                                                </select>
                                                <label for="noPassanger" class="error"></label>
                                            </fieldset>
                                            <div class="nonVehiclePassanger">
                                                <fieldset>
                                                    <label for="noPassangerlesstwo">Number of passenger(age < 2) :</label>
                                                    <select class="noPassangerlesstwo"  name="noPassangerlesstwo" >
                                                        <option value="">Select a number of passenger(age < 2)...</option>
                                                        <?php for ($i = 1; $i < 10; $i++) { ?>
                                                            <option value="<?php print_r($i); ?>"><?php print_r($i); ?></option> 
                                                        <?php } ?>
                                                    </select>
                                                    <label for="noPassangerlesstwo" class="error"></label>
                                                </fieldset>

                                                <fieldset>
                                                    <label for="noPassangerequal">Number of passenger(age >= 2 and age <= 12) :</label>
                                                    <select class="noPassangerequal"  name="noPassangerequal" >
                                                        <option value="">Select a number of passenger(age >= 2 and age <= 12)...</option>
                                                        <?php for ($i = 1; $i < 10; $i++) { ?>
                                                            <option value="<?php print_r($i); ?>"><?php print_r($i); ?></option> 
                                                        <?php } ?>
                                                    </select>
                                                    <label for="noPassangerequal" class="error"></label>
                                                </fieldset>

                                                <fieldset>
                                                    <label for="noPassangerharter">Number of passenger(age > 12) :</label>
                                                    <select class="noPassangerharter"  name="noPassangerharter" >
                                                        <option value="">Select a number of passenger(age > 12)...</option>
                                                        <?php for ($i = 1; $i < 10; $i++) { ?>
                                                            <option value="<?php print_r($i); ?>"><?php print_r($i); ?></option> 
                                                        <?php } ?>
                                                    </select>
                                                    <label for="noPassangerharter" class="error"></label>
                                                </fieldset>

                                                <fieldset class="hidden errorDiv">
                                                    <label for="noPassangerReturn" style="color:red">You selected more than available seat</label>
                                                </fieldset> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 hidden returnFerryTime" >
                                            <fieldset>
                                                <label for="ferryTimeReturn">Return Ferry time :</label>
                                                <select class="ferryTimeReturn"  name="ferryTimeReturn" >
                                                    <option tripid="" value="">Select a ferry time...</option>

                                                </select>
                                                <label for="ferryTimeReturn" class="error"></label>
                                            </fieldset>

                                            <fieldset>
                                                <label for="ferryClassReturn">Return Ferry Class :</label>
                                                <select class="ferryClassReturn"  name="ferryClassReturn" >
                                                    <option value="">Select a ferry class...</option>

                                                </select>
                                                <label for="ferryClassReturn" class="error"></label>
                                            </fieldset>

                                            <fieldset>
                                                <label for="noPassangerReturn">Return ferry's Number of passenger :</label>
                                                <select class="noPassangerReturn"  name="noPassangerReturn" >
                                                    <option value="">Select a number of passenger...</option>

                                                </select>
                                                <label for="noPassangerReturn" class="error"></label>
                                            </fieldset>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <button type="button" id="form-submit" data-prev-form='3' class="pagefour btn prevbtn">Prev</button>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset>
                                                <button type="button" id="form-submit" data-next-form='6' class="btn nextbtn pageSelection">Next</button>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 5 -->
                            <div class="submit-form form5 hidden">
                                <center>
                                    <h4>Select Bus Seat</h4>
                                </center>
                                <!-- Label Div -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry :&nbsp;<span class="ferryText"></span></label>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Type :&nbsp;<span class="ferryTypeText"></span></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Route :&nbsp;<span class="ferryRouteText"></span></label>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Date :&nbsp;<span class="ferryDateText"></span></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Time :&nbsp;<span class="ferryTimeText"></span></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">No of Passenger :&nbsp;<span class="noOfPassanger"></span></label>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Class :&nbsp;<span class="ferryClassText"></span></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-md-12 hidden returnTripTextDiv" id="returnTripTextDiv">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Return Ferry Route:&nbsp;<span class="returnferryRouteText"></span></label>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Return Ferry Date :&nbsp;<span class="returnferryTypeDateText"></span></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                <!-- Input Div -->
                                <span class="seatLayout">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <h4>Select Seat :</h4>
                                            </center>
                                            <div class="col-md-12" >
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="A" >&nbsp;&nbsp;A
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    Driver
                                                </div>
                                            </div>

                                            <div class="col-md-12" >
                                                <div class="col-md-6">
                                                    <div class="pull-right">

                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="B" >&nbsp;&nbsp;B
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="pull-left">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12" >
                                                <div class="col-md-6">
                                                    <div class="pull-right">

                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="C" >&nbsp;&nbsp;C
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="pull-left">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="D" >&nbsp;&nbsp;D
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="E" >&nbsp;&nbsp;E
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12" >
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="1" > 01
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="2" > 02
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="pull-left">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="3" > 03
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="4" > 04
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12" >
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="5" > 05
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="6" > 06
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="pull-left">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="7" > 07
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="8" > 08
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12" >
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="9" > 09
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="10" > 10
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="pull-left">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="11" > 11
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="12" > 12
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12" >
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="13" > 13
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="14" > 14
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="pull-left">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="15" > 15
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="16" > 16
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12" >
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="17" > 17
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="18" > 18
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="pull-left">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="19" > 19
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="20" > 20
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12" >
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="21" > 21
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="22" > 22
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="pull-left">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="23" > 23
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="24" > 24
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12" >
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="25" > 25
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="26" > 26
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="pull-left">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="27" > 27
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="28" > 28
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12" >
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="29" > 29
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="30" > 30
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="pull-left">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="31" > 31
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="32" > 32
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12" >
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="33" > 33
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="34" > 34
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="pull-left">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="35" > 35
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="36" > 36
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12" >
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="37" > 37
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="38" > 38
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="pull-left">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="39" > 39
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="40" > 40
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12" >
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="41" > 41
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="42" > 42
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="pull-left">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="43" > 43
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="44" > 44
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12" >
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="45" > 45
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="46" > 46
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="pull-left">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="47" > 47
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="48" > 48
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12" >
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="49" > 49
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="50" > 50
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="pull-left">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="51" > 51
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="52" > 52
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12" >
                                                <div class="col-md-6">
                                                    <div class="pull-right">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="53" > 53
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="54" > 54
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="pull-left">
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="55" > 55
                                                        <input type="checkbox" name="seat[]" class="selectSeat" value="56" > 56
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12" >
                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-8">
                                                        <fieldset class="hidden errorDivSelectSeat">
                                                            <center><label for="noPassangerReturn" style="color:red">You select seat  more than no of passenger </label></center>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </span>
                                <!-- Button Div -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <button type="button" id="form-submit" data-prev-form='4' class="pagefour btn prevbtn">Prev</button>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset>
                                                <button type="button" id="form-submit" data-next-form='6' class="btn nextbtn">Next</button>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Step 6 -->
                            <div class="submit-form form6 hidden">
                                <center>
                                    <h4>Passenger Details</h4>
                                    <p class="updatebookingerror" style="color:red"></p>
                                </center>
                                <!-- Label Div -->
                                <div class="row">
                                    <div class="col-md-12 hidden">
                                        <input type="text" id="bookingId" name="bookingId">
                                        <input type="text" id="tripID" name="tripID">
                                        <input type="text" id="freeseats" name="freeseats">
                                        <input type="text" id="totalfare" name="totalfare">
                                        <input type="text" id="vehicleTotalFare" name="vehicleTotalFare">
                                        <input type="text" id="grandtotal" name="grandtotal">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Route :&nbsp;<span class="ferryRouteText"></span></label>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Type :&nbsp;<span class="ferryTypeText"></span></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Time :&nbsp;<span class="ferryTimeText"></span></label>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Date :&nbsp;<span class="ferryDateText"></span></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">No of Passenger :&nbsp;<span class="noOfPassanger"></span></label>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Class :&nbsp;<span class="ferryClassText"></span></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Total Amount :&nbsp;<span class="totalamountText"></span></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                <!-- Input Div -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <fieldset>
                                                <label for="tripDropTime" style="margin-left:7px">Email Address :</label>
                                                <input type="text" name="emailAddress" id="emailAddress" class="emailAddress form-control" placeholder="Enter your email address" autocomplete="off">
                                                <label for="emailAddress" class=" error"></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <fieldset>
                                                <label for="phoneNumber" style="margin-left:7px">Phone number :</label>
                                                <input type="text" class="phoneNumber form-control"  id="phoneNumber" name="phoneNumber" placeholder="Enter your phone number" autocomplete="off">
                                                <label for="phoneNumber" class=" error"></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="phoneNumber" style="margin-left:7px">City Name :</label>
                                                <input type="text" class="form-control"  name="cityName" placeholder="Enter your city name" autocomplete="off">
                                                <label for="cityName" class=" error"></label>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="phoneNumber" style="margin-left:7px">Pin code :</label>
                                                <input type="number" class="form-control"  name="pinCode" placeholder="Enter your phone pin code" autocomplete="off">
                                                <label for="pinCode" class=" error"></label>
                                            </fieldset>
                                        </div>

                                    </div>
                                    <div class="withvehicleDetails">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <fieldset>
                                                    <label for="Vehicle No" style="margin-left:7px">Vehicle No :</label>
                                                    <input type="text" class="vehicleNo form-control"  id="vehicleNo" name="vehicleNo" placeholder="Enter your vehicle no" autocomplete="off">
                                                    <label for="vehicleNo" class=" error"></label>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <fieldset>
                                                    <label for="licenseNo" style="margin-left:7px">Driver License NO :</label>
                                                    <input type="text" class="licenseNo form-control" id="licenseNo" name="licenseNo" placeholder="Enter your driver license no" autocomplete="off">
                                                    <label for="licenseNo" class=" error"></label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-md-12 passangerDiv" style="margin-top:30px">

                                        </div>
                                    </div>
                                </div>
                                <!-- Button Div -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <button type="button" id="form-submit" data-prev-form='4' class="passangerDetails btn prevbtn">Prev</button>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset>
                                                <button type="button" id="form-submit" data-next-form='7' class="btn nextbtn">Next</button>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 7 -->
                            <div class="submit-form form7 hidden">
                                <center>
                                    <h4>Confirm Your Ticket</h4>
                                </center>
                                <!-- Label Div -->
                                <div class="row">
                                    <div class="col-md-12 hidden">
                                        <input type="text" id="pnrNo" name="pnrNo">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Route :&nbsp;<span class="ferryRouteText"></span></label>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Type :&nbsp;<span class="ferryTypeText"></span></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Time :&nbsp;<span class="ferryTimeText"></span></label>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">Ferry Date :&nbsp;<span class="ferryDateText"></span></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="from">No of Passenger :&nbsp;<span class="noOfPassanger" id="noOfPassanger"></span></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                </div>
                                <br><br>
                                <!-- Input Div -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            <h4>Confirm Passenger's Details :</h4>
                                            <p class="confirmError" style="color:red"></p>
                                        </center>
                                        <div class="col-md-12" >
                                            <div class="col-md-12">
                                                <fieldset>
                                                    <label for="from">Your Email : &nbsp;<span class="passangrrEmailText"></span></label>
                                                </fieldset>
                                            </div>

                                        </div>

                                        <div class="col-md-12" >
                                            <div class="col-md-12">
                                                <fieldset>
                                                    <label for="from">Your Phone Number : &nbsp;<span class="phoneNumberText"></span></label>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="vehicledetails ">
                                            <div class="col-md-12" >
                                                <div class="col-md-12">
                                                    <fieldset>
                                                        <label for="from">Your Vehicle No : &nbsp;<span class="vehicleNOText"></span></label>
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <div class="col-md-12" >
                                                <div class="col-md-12">
                                                    <fieldset>
                                                        <label for="from">Your License No : &nbsp;<span class="lincenseNoText"></span></label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" >
                                            <div class="col-md-12">
                                                <fieldset>
                                                    <label for="from">Total Amount : &nbsp;<span class="totalamountText"></span></label>
                                                </fieldset>
                                            </div>
                                        </div>


                                        <div class="passangeTextDiv">

                                        </div>
                                    </div>
                                </div>
                                <!-- Button Div -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <button type="button" id="form-submit" data-prev-form='6' class="pagefour btn prevbtn">Prev</button>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset>
                                                <button type="submit" id="form-submit" data-next-form='8' class="btn nextbtn">Make Payment</button>
                                            </fieldset>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>

</section>
>
<div class="tabs-content" id="weather">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Check Weather For 5 NEXT Days</h2>
                </div>
            </div>
            <div class="wrapper">
                <div class="col-md-12">
                    <div class="weather-content">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="tabs clearfix" data-tabgroup="second-tab-group">
                                    <li><a href="#monday" class="active">Monday</a></li>
                                    <li><a href="#tuesday">Tuesday</a></li>
                                    <li><a href="#wednesday">Wednesday</a></li>
                                    <li><a href="#thursday">Thursday</a></li>
                                    <li><a href="#friday">Friday</a></li>
                                </ul>    
                            </div>
                            <div class="col-md-12">
                                <section id="second-tab-group" class="weathergroup">
                                    <div id="monday">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="weather-item">
                                                    <h6>Myanmar</h6>
                                                    <div class="weather-icon">
                                                        <img src="<?php echo base_url() ?>public/asset/front/img/weather-icon-03.png" alt="">
                                                    </div>
                                                    <span>32&deg;C</span>
                                                    <ul class="time-weather">
                                                        <li>6AM <span>26&deg;</span></li>
                                                        <li>12PM <span>32&deg;</span></li>
                                                        <li>6PM <span>28&deg;</span></li>
                                                        <li>12AM <span>22&deg;</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="weather-item">
                                                    <h6>Thailand</h6>
                                                    <div class="weather-icon">
                                                        <img src="<?php echo base_url() ?>public/asset/front/img/weather-icon-02.png" alt="">
                                                    </div>
                                                    <span>28&deg;C</span>
                                                    <ul class="time-weather">
                                                        <li>6AM <span>20&deg;</span></li>
                                                        <li>12PM <span>28&deg;</span></li>
                                                        <li>6PM <span>26&deg;</span></li>
                                                        <li>12AM <span>18&deg;</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="weather-item">
                                                    <h6>India</h6>
                                                    <div class="weather-icon">
                                                        <img src="<?php echo base_url() ?>public/asset/front/img/weather-icon-01.png" alt="">
                                                    </div>
                                                    <span>33&deg;C</span>
                                                    <ul class="time-weather">
                                                        <li>6AM <span>26&deg;</span></li>
                                                        <li>12PM <span>33&deg;</span></li>
                                                        <li>6PM <span>29&deg;</span></li>
                                                        <li>12AM <span>27&deg;</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tuesday">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="weather-item">
                                                    <h6>Myanmar</h6>
                                                    <div class="weather-icon">
                                                        <img src="<?php echo base_url() ?>public/asset/front/img/weather-icon-02.png" alt="">
                                                    </div>
                                                    <span>28&deg;C</span>
                                                    <ul class="time-weather">
                                                        <li>6AM <span>18&deg;</span></li>
                                                        <li>12PM <span>27&deg;</span></li>
                                                        <li>6PM <span>25&deg;</span></li>
                                                        <li>12AM <span>17&deg;</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="weather-item">
                                                    <h6>Thailand</h6>
                                                    <div class="weather-icon">
                                                        <img src="<?php echo base_url() ?>public/asset/front/img/weather-icon-03.png" alt="">
                                                    </div>
                                                    <span>31&deg;C</span>
                                                    <ul class="time-weather">
                                                        <li>6AM <span>19&deg;</span></li>
                                                        <li>12PM <span>28&deg;</span></li>
                                                        <li>6PM <span>22&deg;</span></li>
                                                        <li>12AM <span>18&deg;</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="weather-item">
                                                    <h6>India</h6>
                                                    <div class="weather-icon">
                                                        <img src="<?php echo base_url() ?>public/asset/front/img/weather-icon-01.png" alt="">
                                                    </div>
                                                    <span>26&deg;C</span>
                                                    <ul class="time-weather">
                                                        <li>6AM <span>19&deg;</span></li>
                                                        <li>12PM <span>26&deg;</span></li>
                                                        <li>6PM <span>22&deg;</span></li>
                                                        <li>12AM <span>20&deg;</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="wednesday">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="weather-item">
                                                    <h6>Myanmar</h6>
                                                    <div class="weather-icon">
                                                        <img src="<?php echo base_url() ?>public/asset/front/img/weather-icon-03.png" alt="">
                                                    </div>
                                                    <span>31&deg;C</span>
                                                    <ul class="time-weather">
                                                        <li>6AM <span>19&deg;</span></li>
                                                        <li>12PM <span>28&deg;</span></li>
                                                        <li>6PM <span>22&deg;</span></li>
                                                        <li>12AM <span>18&deg;</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="weather-item">
                                                    <h6>Thailand</h6>
                                                    <div class="weather-icon">
                                                        <img src="<?php echo base_url() ?>public/asset/front/img/weather-icon-01.png" alt="">
                                                    </div>
                                                    <span>34&deg;C</span>
                                                    <ul class="time-weather">
                                                        <li>6AM <span>28&deg;</span></li>
                                                        <li>12PM <span>34&deg;</span></li>
                                                        <li>6PM <span>30&deg;</span></li>
                                                        <li>12AM <span>29&deg;</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="weather-item">
                                                    <h6>India</h6>
                                                    <div class="weather-icon">
                                                        <img src="<?php echo base_url() ?>public/asset/front/img/weather-icon-02.png" alt="">
                                                    </div>
                                                    <span>28&deg;C</span>
                                                    <ul class="time-weather">
                                                        <li>6AM <span>18&deg;</span></li>
                                                        <li>12PM <span>27&deg;</span></li>
                                                        <li>6PM <span>25&deg;</span></li>
                                                        <li>12AM <span>17&deg;</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="thursday">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="weather-item">
                                                    <h6>Myanmar</h6>
                                                    <div class="weather-icon">
                                                        <img src="<?php echo base_url() ?>public/asset/front/img/weather-icon-01.png" alt="">
                                                    </div>
                                                    <span>27&deg;C</span>
                                                    <ul class="time-weather">
                                                        <li>6AM <span>21&deg;</span></li>
                                                        <li>12PM <span>27&deg;</span></li>
                                                        <li>6PM <span>22&deg;</span></li>
                                                        <li>12AM <span>18&deg;</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="weather-item">
                                                    <h6>Thailand</h6>
                                                    <div class="weather-icon">
                                                        <img src="<?php echo base_url() ?>public/asset/front/img/weather-icon-02.png" alt="">
                                                    </div>
                                                    <span>28&deg;C</span>
                                                    <ul class="time-weather">
                                                        <li>6AM <span>18&deg;</span></li>
                                                        <li>12PM <span>27&deg;</span></li>
                                                        <li>6PM <span>25&deg;</span></li>
                                                        <li>12AM <span>17&deg;</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="weather-item">
                                                    <h6>India</h6>
                                                    <div class="weather-icon">
                                                        <img src="<?php echo base_url() ?>public/asset/front/img/weather-icon-03.png" alt="">
                                                    </div>
                                                    <span>31&deg;C</span>
                                                    <ul class="time-weather">
                                                        <li>6AM <span>19&deg;</span></li>
                                                        <li>12PM <span>28&deg;</span></li>
                                                        <li>6PM <span>22&deg;</span></li>
                                                        <li>12AM <span>18&deg;</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="friday">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="weather-item">
                                                    <h6>Myanmar</h6>
                                                    <div class="weather-icon">
                                                        <img src="<?php echo base_url() ?>public/asset/front/img/weather-icon-03.png" alt="">
                                                    </div>
                                                    <span>33&deg;C</span>
                                                    <ul class="time-weather">
                                                        <li>6AM <span>28&deg;</span></li>
                                                        <li>12PM <span>33&deg;</span></li>
                                                        <li>6PM <span>29&deg;</span></li>
                                                        <li>12AM <span>27&deg;</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="weather-item">
                                                    <h6>Thailand</h6>
                                                    <div class="weather-icon">
                                                        <img src="<?php echo base_url() ?>public/asset/front/img/weather-icon-02.png" alt="">
                                                    </div>
                                                    <span>31&deg;C</span>
                                                    <ul class="time-weather">
                                                        <li>6AM <span>24&deg;</span></li>
                                                        <li>12PM <span>31&deg;</span></li>
                                                        <li>6PM <span>26&deg;</span></li>
                                                        <li>12AM <span>23&deg;</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="weather-item">
                                                    <h6>India</h6>
                                                    <div class="weather-icon">
                                                        <img src="<?php echo base_url() ?>public/asset/front/img/weather-icon-01.png" alt="">
                                                    </div>
                                                    <span>28&deg;C</span>
                                                    <ul class="time-weather">
                                                        <li>6AM <span>24&deg;</span></li>
                                                        <li>12PM <span>28&deg;</span></li>
                                                        <li>6PM <span>26&deg;</span></li>
                                                        <li>12AM <span>22&deg;</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="services">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="service-item first-service">
                    <div class="service-icon"></div>
                    <h4>Easy Tooplate</h4>
                    <p>Donec varius porttitor iaculis. Integer sollicitudin erat et ligula viverra vulputate. In in quam efficitur, pulvinar justo ut, tempor nunc. Phasellus pharetra quis odio.</p>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-item second-service">
                    <div class="service-icon"></div>
                    <h4>Unique Ideas</h4>
                    <p>Cras ligula diam, tristique at aliquam at, fermentum auctor turpis. Proin leo massa, iaculis elementum massa et, consectetur varius dolor. Fusce sed ipsum sit.</p>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-item third-service">
                    <div class="service-icon"></div>
                    <h4>Best Support</h4>
                    <p>Fusce leo dui. Mauris et justo eget arcu ultricies porta. Nulla facilisi. Nulla nec risus sit amet magna hendrerit venenatis. Sed porta tincidunt lectus eget ultrices.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="tabs-content" id="recommended-hotel">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Recommended Hotel For You</h2>
                </div>
            </div>
            <div class="wrapper">
                <div class="col-md-4">
                    <ul class="tabs clearfix" data-tabgroup="third-tab-group">
                        <li><a href="#livingroom" class="active">Living Room <i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#suitroom">Suit Room <i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#swimingpool">Swiming Pool <i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#massage">Massage Service <i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#fitness">Fitness Life <i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#event">Evening Event <i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <section id="third-tab-group" class="recommendedgroup">
                    <div id="livingroom">
                        <div class="text-content">
                            <iframe width="100%" height="400px" src="https://www.youtube.com/embed/rMxTreSFMgE">
                            </iframe>
                        </div>
                    </div>
                    <div id="suitroom">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="owl-suiteroom" class="owl-carousel owl-theme">
                                    <div class="item">
                                        <div class="suiteroom-item">
                                            <img src="<?php echo base_url() ?>public/asset/front/img/suite-02.jpg" alt="">
                                            <div class="text-content">
                                                <h4>Clean And Relaxing Room</h4>
                                                <span>Aurora Resort</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="suiteroom-item">
                                            <img src="<?php echo base_url() ?>public/asset/front/img/suite-01.jpg" alt="">
                                            <div class="text-content">
                                                <h4>Special Suite Room TV</h4>
                                                <span>Khao Yai Hotel</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="suiteroom-item">
                                            <img src="<?php echo base_url() ?>public/asset/front/img/suite-03.jpg" alt="">
                                            <div class="text-content">
                                                <h4>The Best Sitting</h4>
                                                <span>Hotel Grand</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="swimingpool">
                        <img src="<?php echo base_url() ?>public/asset/front/img/swiming-pool.jpg" alt="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-content">
                                    <h4>Lovely View Swiming Pool For Special Guests</h4>
                                    <span>Victoria Resort and Spa</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="massage">
                        <img src="<?php echo base_url() ?>public/asset/front/img/massage-service.jpg" alt="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-content">
                                    <h4>Perfect Place For Relaxation</h4>
                                    <span>Napali Beach</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="fitness">
                        <img src="<?php echo base_url() ?>public/asset/front/img/fitness-service.jpg" alt="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-content">
                                    <h4>Insane Street Workout</h4>
                                    <span>Hua Hin Beach</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="event">
                        <img src="<?php echo base_url() ?>public/asset/front/img/evening-event.jpg" alt="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-content">
                                    <h4>Finest Winery Night</h4>
                                    <span>Queen Restaurant</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<section id="most-visited">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Most Visited Places</h2>
                </div>
            </div>
            <div class="col-md-12">
                <div id="owl-mostvisited" class="owl-carousel owl-theme">
                    <div class="item col-md-12">
                        <div class="visited-item">
                            <img src="<?php echo base_url() ?>public/asset/front/img/place-01.jpg" alt="">
                            <div class="text-content">
                                <h4>River Views</h4>
                                <span>New York</span>
                            </div>
                        </div>
                    </div>
                    <div class="item col-md-12">
                        <div class="visited-item">
                            <img src="<?php echo base_url() ?>public/asset/front/img/place-02.jpg" alt="">
                            <div class="text-content">
                                <h4>Lorem ipsum dolor</h4>
                                <span>Tokyo</span>
                            </div>
                        </div>
                    </div>
                    <div class="item col-md-12">
                        <div class="visited-item">
                            <img src="<?php echo base_url() ?>public/asset/front/img/place-03.jpg" alt="">
                            <div class="text-content">
                                <h4>Proin dignissim</h4>
                                <span>Paris</span>
                            </div>
                        </div>
                    </div>
                    <div class="item col-md-12">
                        <div class="visited-item">
                            <img src="<?php echo base_url() ?>public/asset/front/img/place-04.jpg" alt="">
                            <div class="text-content">
                                <h4>Fusce sed ipsum</h4>
                                <span>Hollywood</span>
                            </div>
                        </div>
                    </div>
                    <div class="item col-md-12">
                        <div class="visited-item">
                            <img src="<?php echo base_url() ?>public/asset/front/img/place-02.jpg" alt="">
                            <div class="text-content">
                                <h4>Vivamus egestas</h4>
                                <span>Tokyo</span>
                            </div>
                        </div>
                    </div>
                    <div class="item col-md-12">
                        <div class="visited-item">
                            <img src="<?php echo base_url() ?>public/asset/front/img/place-01.jpg" alt="">
                            <div class="text-content">
                                <h4>Aliquam elit metus</h4>
                                <span>New York</span>
                            </div>
                        </div>
                    </div>
                    <div class="item col-md-12">
                        <div class="visited-item">
                            <img src="<?php echo base_url() ?>public/asset/front/img/place-03.jpg" alt="">
                            <div class="text-content">
                                <h4>Phasellus pharetra</h4>
                                <span>Paris</span>
                            </div>
                        </div>
                    </div>
                    <div class="item col-md-12">
                        <div class="visited-item">
                            <img src="<?php echo base_url() ?>public/asset/front/img/place-04.jpg" alt="">
                            <div class="text-content">
                                <h4>In in quam efficitur</h4>
                                <span>Hollywood</span>
                            </div>
                        </div>
                    </div>
                    <div class="item col-md-12">
                        <div class="visited-item">
                            <img src="<?php echo base_url() ?>public/asset/front/img/place-01.jpg" alt="">
                            <div class="text-content">
                                <h4>Sed faucibus odio</h4>
                                <span>NEW YORK</span>
                            </div>
                        </div>
                    </div>
                    <div class="item col-md-12">
                        <div class="visited-item">
                            <img src="<?php echo base_url() ?>public/asset/front/img/place-02.jpg" alt="">
                            <div class="text-content">
                                <h4>Donec varius porttitor</h4>
                                <span>Tokyo</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

