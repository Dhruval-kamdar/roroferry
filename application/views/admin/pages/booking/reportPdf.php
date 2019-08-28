<!DOCTYPE html>
<html>
    <head></head>
    <body>
    <table class="table">
        <tr>
            <td colspan="6" style="text-align: center!important">
                    <h3>Mahavir Tours & Travels</h3><br>
                    9,Patel Shopping Center, Beside Shital Hotel,Nr Railway Station Bharuch <br>
                    Mo : 9737811326 || Email Id : harshilshah90@yahoo.com / inquiry@roroferry.in
            </td>
        </tr>
        <hr><br>
        
        <tr>
            <td colspan="6" style="text-align: center!important">
                <br><br>
                <span>Roroferry Report Ticket</span>
            </td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: center!important">
            </td>
        </tr>
        <br>
        <tr>
            <td colspan="2" style="text-align: left!important">
                Report Date : <?php print_r(date('d-m-Y', strtotime($date)));?>
            </td>
            
            <td colspan="2" style="text-align: center!important">
                Ferry Time : <?php print_r($ferryTime);?>
            </td>
            
            <td colspan="2" style="text-align: right!important">
                Route : <?php print_r($routeName);?>
            </td>
        </tr>
        
        <tr >
            <td colspan="6">
                <br><br>
                <table border="1" cellpadding="5">
                    <tr>
                        <td>No</td>
                        <td>PNR Number</td>
                        <td>Seat No</td>
                        <td>Name</td>
                        <td>Sex / Age</td>
                        <td>Mobile Number</td> 
                        <td>Pickup Point</td> 
                    </tr>
                    <?php if(count($passangerDetails) > 0){?>
                            <?php for($i = 0 ;$i < count($passangerDetails) ;$i++){?>
                                <tr>
                                    <td><?php print_r($i+1);?></td>
                                    <td><?php print_r($passangerDetails[$i]->pnrNumber); ?></td>
                                    <td><?php print_r($passangerDetails[$i]->seatNo); ?></td>
                                    <td><?php print_r($passangerDetails[$i]->passangerName); ?></td>
                                    <td><?php print_r($passangerDetails[$i]->passangerGender.' / '.$passangerDetails[$i]->passangerAge);?></td>
                                    <td><?php print_r($passangerDetails[$i]->phoneNumber);?></td> 
                                    <td><?php print_r($passangerDetails[$i]->pickUpStation);?></td> 
                                </tr>
                            <?php }?>
                    <?php }else { ?> 
                                <tr>
                                    <td colspan="7" style="text-align: center!important">No passanger booked ticket for this route</td>
                                </tr>
                            <?php } ?>
                </table>
            </td>
        </tr>
         
    </table>
    </body>
</html>