<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

   
    
   
    <title>PDF</title>
</head>
<style>



body{
 
  font-family: 'Roboto', sans-serif;
  box-sizing: border-box;
}
::selection {background: #f31544; color: #FFF;}
::moz-selection {background: #f31544; color: #FFF;}
h1{
  font-size: 1.5em;
  color: #222;
}
h2{font-size: .9em;}
h3{
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
p{
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}

#invoiceholder{
  width:99%;
  height:100%;
}

#invoice{
    width: 99%;
    background: #FFF; 
    box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.2), 0px 6px 20px 0px rgba(0, 0, 0, 0.19);
}

[id*='invoice-']{ /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
  padding: 30px;
}

#invoice-top{min-height: 120px;}
#invoice-mid{min-height: 120px;}
#invoice-bot{min-height: 250px;}

.logo{
  float: left;
	height: 60px;
	width: 60px;
	background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
	background-size: 60px 60px;
}
.clientlogo{
  float: left;
	height: 60px;
	width: 60px;
	background: url('') no-repeat;
	background-size: 60px 60px;
  border-radius: 50px;
}
.info{
  display: block;
  float:left;
  margin-left: 20px;
}
.title{
  float: right;
}
.title p{text-align: right;}
#project{margin-left: 52%;}
table{
  width: 100%;
  border-collapse: collapse;
}
td{
  padding: 5px 0 5px 15px;
  border: 1px solid #EEE
}
.tabletitle{
  padding: 5px;
  background: #EEE;
}
.service{border: 1px solid #EEE;}
.item{width: 50%;}
.itemtext{font-size: .9em;}

#legalcopy{
  margin-top: 30px;
}
form{
  float:right;
  margin-top: 30px;
  text-align: right;
}


.effect2
{
  position: relative;
}
.effect2:before, .effect2:after
{
  z-index: -1;
  position: absolute;
  content: "";
  bottom: 15px;
  left: 10px;
  width: 50%;
  top: 80%;
  max-width:300px;
  background: #777;
 
}

.legal{
  width:70%;
}

</style>
<body>
    <div id="invoiceholder" class="shadow">

        <div id="headerimage"></div>
        <div id="invoice" >
          
          <div id="invoice-top">
            <div >
              <img src="C:\Users\Syaafi\Desktop\Project\fyp3\public\img\logoHDR.png" class="logo" >
            </div>
            <div class="info">
              <h2>Human Detection Robot </h2>
              <p> MadeBySyaafi <br>
                  Tel: 011-11385109
              </p>
            </div><!--End Info-->
            <div class="title">
              @foreach ($users as $user)
              <h1>Report #00{{$user->id}}</h1>
             
              @endforeach
            
              <p>Issued: May 27, 2015<br>
                 
              </p>
            </div><!--End Title-->
          </div><!--End InvoiceTop-->
      
      
          
          <div id="invoice-mid">
            
            <div >
              <img src="C:\Users\Syaafi\Desktop\Project\fyp3\public\img\client.jpg" class="clientlogo" >
            </div>
            <div class="info">
              @foreach ($users as $user)
              <h2>USER: {{$user->name}}</h2>
              <p>EMAIL: {{$user->email}}<br>
                555-555-5555<br>
              @endforeach
              
              
            </div>
      
            <div id="project">
              @foreach ($evis as $evi)
            <h2>PROJECT NAME: {{$evi->EventName}}</h2>
            <p>PROJECT DESCRIPTION: {{$evi->EventDescription}}</p>
            <p>PROJECT LOCATION: </p>
              @endforeach
            </div>   
      
          </div><!--End Invoice Mid-->
          
          <div id="invoice-bot">
            @foreach ($evis as $evi)
                <h2>EVIDENCE</h2>
            <h2></h2>
            
            <div id="table">
              <table>
                <tr class="tabletitle">
                  <td class="item"><h2>DateTime</h2></td>
                  <td class="Hours"><h2>Picture</h2></td>
                  <td class="Rate"><h2>Thermal</h2></td>
                  <td class="subtotal"><h2>Longitude</h2></td>
                  <td class="subtotal"><h2>Latitude</h2></td>
                </tr>
                @foreach ($evi->evidence as $item)
                <tr class="service">
                <td class="tableitem"><p class="itemtext">{{$item->DateTime}}</p></td>
                <td class="tableitem"><p class="itemtext"><img src="C:\Users\Syaafi\Desktop\Project\fyp3\public\img\{{$item->Picture}}" width="100" height="50"> </p></td>
                  <td class="tableitem"><p class="itemtext"><img src="C:\Users\Syaafi\Desktop\Project\fyp3\public\img\{{$item->Thermal}}" width="100" height="50"></p></td>
                  <td class="tableitem"><p class="itemtext">{{$item->Longitude}}</p></td>
                  <td class="tableitem"><p class="itemtext">{{$item->Latitude}}</p></td>
                </tr>
                @endforeach
                
               
                
            
              </table>
              @endforeach
            </div><!--End Table-->
            
          
      
            
            <div id="legalcopy">
              <p class="legal"><strong>Thank you for your business!</strong>  If there any inquire pls email me ahmadsyaafi96@yahoo.com
              </p>
            </div>
            
          </div><!--End InvoiceBot-->
        </div><!--End Invoice-->

      </div><!-- End Invoice Holder-->
</body>
</html>