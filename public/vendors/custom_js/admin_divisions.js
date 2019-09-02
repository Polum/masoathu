$(function () {

    //get data from database on selected Goal

});

/**
 *function to display the different administrative divisions
 * @param url
 * @param id
 */
function switchAdminDivisions(url, id) {
    let adminDivisionUrl = url + "/" + id;
    let divisionDisplay;
    console.log(adminDivisionUrl);
    $.get(adminDivisionUrl, function (data) {
        var currentAdminData = data.data;
        console.log(currentAdminData);
        var divisionId = currentAdminData[0];
        var divisionLevelName = currentAdminData[1];
        var divisionDataSet = currentAdminData[2];
        console.log(currentAdminData[0]);
        console.log(currentAdminData[1]);
        console.log(divisionDataSet.length);
        $(".level-title").html(divisionLevelName).hide().fadeIn('slow');
        //currentAdminData.data
        switch (id) {

            case 1 :
                divisionDisplay = "";
                for( $i=0; $i<divisionDataSet.length; $i++){
                    divisionDisplay += "<div class=\"col-lg-3 col-md-6 col-sm-12 text-center mb-30\">\n" +
                        "                                    <div class=\"panel panel-pricing mb-0\">\n" +
                        "                                        <div class=\"panel-heading\">\n" +
                        "                                            <i class=\" ti-shield\"></i>\n" +
                        "                                            <span class=\"panel-price\" style=\"font-size: 30px;\">"+divisionDataSet[$i].name +"</span>\n" +
                        "                                        </div>\n" +
                        "                                        <div class=\"panel-body text-center pl-0 pr-0\">\n" +
                        "                                            <hr class=\"mb-30\"/>\n" +
                        "                                            <ul class=\"list-group mb-0 text-center\">\n" +
                        "                                                <li class=\"list-group-item\"><i class=\"fa fa-check\"></i> 4 Regions</li>\n" +
                        "                                            </ul>\n" +
                        "                                        </div>\n" +
                        "                                        <div class=\"panel-footer pb-35\">\n" +
                        "                                            <button class=\"btn btn-success btn-rounded btn-lg admin-req-button\"\n" +
                        "                                                    onClick=\"switchAdminDivisions("+ url +","+ divisionId+1 +")\">View\n" +
                        "                                            </button>\n" +
                        "                                        </div>\n" +
                        "                                    </div>\n" +
                        "                                </div>\n" +
                        "                                <!-- /item -->";
                }


                scrollToSectionTop("top-admin-section");
                break;
            case 2 :
                divisionDisplay = "<div class=\"panel panel-default card-view\">\n" +
                    "\t\t\t\t\t\t\t<div class=\"panel-heading\">\n" +
                    "\t\t\t\t\t\t\t\t<div class=\"pull-left\">\n" +
                    "\t\t\t\t\t\t\t\t\t<h6 class=\"panel-title txt-dark\">data Table</h6>\n" +
                    "\t\t\t\t\t\t\t\t</div>\n" +
                    "\t\t\t\t\t\t\t\t<div class=\"clearfix\"></div>\n" +
                    "\t\t\t\t\t\t\t</div>\n" +
                    "\t\t\t\t\t\t\t<div class=\"panel-wrapper collapse in\">\n" +
                    "\t\t\t\t\t\t\t\t<div class=\"panel-body\">\n" +
                    "\t\t\t\t\t\t\t\t\t<div class=\"table-wrap\">\n" +
                    "\t\t\t\t\t\t\t\t\t\t<div class=\"table-responsive\">\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t<table id=\"datable_1\" class=\"table table-hover display  pb-30\" >\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t<thead>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<th>Name</th>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<th>Position</th>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<th>Office</th>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<th>Age</th>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<th>Start date</th>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<th>Salary</th>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t</thead>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t<tfoot>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<th>Name</th>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<th>Position</th>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<th>Office</th>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<th>Age</th>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<th>Start date</th>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<th>Salary</th>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t</tfoot>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t<tbody>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Tiger Nixon</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>System Architect</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Edinburgh</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>61</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2011/04/25</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$320,800</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Garrett Winters</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Accountant</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Tokyo</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>63</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2011/07/25</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$170,750</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Ashton Cox</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Junior Technical Author</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>San Francisco</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>66</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2009/01/12</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$86,000</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Cedric Kelly</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Senior Javascript Developer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Edinburgh</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>22</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2012/03/29</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$433,060</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Airi Satou</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Accountant</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Tokyo</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>33</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2008/11/28</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$162,700</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Brielle Williamson</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Integration Specialist</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>New York</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>61</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2012/12/02</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$372,000</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Herrod Chandler</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Sales Assistant</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>San Francisco</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>59</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2012/08/06</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$137,500</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Rhona Davidson</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Integration Specialist</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Tokyo</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>55</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2010/10/14</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$327,900</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Colleen Hurst</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Javascript Developer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>San Francisco</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>39</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2009/09/15</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$205,500</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Sonya Frost</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Software Engineer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Edinburgh</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>23</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2008/12/13</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$103,600</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Jena Gaines</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Office Manager</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>London</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>30</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2008/12/19</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$90,560</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Quinn Flynn</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Support Lead</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Edinburgh</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>22</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2013/03/03</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$342,000</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Charde Marshall</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Regional Director</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>San Francisco</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>36</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2008/10/16</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$470,600</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Haley Kennedy</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Senior Marketing Designer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>London</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>43</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2012/12/18</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$313,500</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Tatyana Fitzpatrick</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Regional Director</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>London</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>19</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2010/03/17</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$385,750</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Michael Silva</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Marketing Designer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>London</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>66</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2012/11/27</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$198,500</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Paul Byrd</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Chief Financial Officer (CFO)</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>New York</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>64</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2010/06/09</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$725,000</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Gloria Little</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Systems Administrator</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>New York</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>59</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2009/04/10</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$237,500</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Bradley Greer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Software Engineer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>London</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>41</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2012/10/13</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$132,000</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Dai Rios</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Personnel Lead</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Edinburgh</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>35</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2012/09/26</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$217,500</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Jenette Caldwell</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Development Lead</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>New York</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>30</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2011/09/03</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$345,000</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Yuri Berry</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Chief Marketing Officer (CMO)</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>New York</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>40</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2009/06/25</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$675,000</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Caesar Vance</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Pre-Sales Support</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>New York</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>21</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2011/12/12</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$106,450</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Doris Wilder</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Sales Assistant</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Sidney</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>23</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2010/09/20</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$85,600</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Angelica Ramos</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Chief Executive Officer (CEO)</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>London</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>47</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2009/10/09</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$1,200,000</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Gavin Joyce</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Developer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Edinburgh</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>42</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2010/12/22</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$92,575</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Jennifer Chang</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Regional Director</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Singapore</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>28</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2010/11/14</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$357,650</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Brenden Wagner</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Software Engineer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>San Francisco</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>28</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2011/06/07</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$206,850</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Fiona Green</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Chief Operating Officer (COO)</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>San Francisco</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>48</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2010/03/11</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$850,000</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Shou Itou</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Regional Marketing</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Tokyo</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>20</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2011/08/14</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$163,000</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Michelle House</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Integration Specialist</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Sidney</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>37</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2011/06/02</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$95,400</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Suki Burks</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Developer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>London</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>53</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2009/10/22</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$114,500</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Prescott Bartlett</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Technical Author</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>London</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>27</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2011/05/07</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$145,000</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Gavin Cortez</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Team Leader</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>San Francisco</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>22</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2008/10/26</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$235,500</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Martena Mccray</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Post-Sales support</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Edinburgh</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>46</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2011/03/09</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$324,050</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Unity Butler</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Marketing Designer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>San Francisco</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>47</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2009/12/09</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$85,675</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Howard Hatfield</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Office Manager</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>San Francisco</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>51</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2008/12/16</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$164,500</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Hope Fuentes</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Secretary</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>San Francisco</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>41</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2010/02/12</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$109,850</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Vivian Harrell</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Financial Controller</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>San Francisco</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>62</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2009/02/14</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$452,500</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Timothy Mooney</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Office Manager</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>London</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>37</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2008/12/11</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$136,200</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Jackson Bradshaw</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Director</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>New York</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>65</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2008/09/26</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$645,750</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Olivia Liang</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Support Engineer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Singapore</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>64</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2011/02/03</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$234,500</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Bruno Nash</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Software Engineer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>London</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>38</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2011/05/03</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$163,500</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Sakura Yamamoto</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Support Engineer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Tokyo</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>37</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2009/08/19</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$139,575</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Thor Walton</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Developer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>New York</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>61</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2013/08/11</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$98,540</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Finn Camacho</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Support Engineer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>San Francisco</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>47</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2009/07/07</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$87,500</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Serge Baldwin</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Data Coordinator</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Singapore</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>64</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2012/04/09</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$138,575</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Zenaida Frank</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Software Engineer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>New York</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>63</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2010/01/04</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$125,250</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Zorita Serrano</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Software Engineer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>San Francisco</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>56</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2012/06/01</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$115,000</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Jennifer Acosta</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Junior Javascript Developer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Edinburgh</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>43</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2013/02/01</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$75,650</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Cara Stevens</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Sales Assistant</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>New York</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>46</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2011/12/06</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$145,600</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Hermione Butler</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Regional Director</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>London</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>47</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2011/03/21</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$356,250</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Lael Greer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Systems Administrator</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>London</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>21</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2009/02/27</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$103,500</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Jonas Alexander</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Developer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>San Francisco</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>30</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2010/07/14</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$86,500</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Shad Decker</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Regional Director</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Edinburgh</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>51</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2008/11/13</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$183,000</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Michael Bruce</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Javascript Developer</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Singapore</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>29</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2011/06/27</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$183,000</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Donna Snider</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>Customer Support</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>New York</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>27</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>2011/01/25</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>$112,000</td>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t</tbody>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t</table>\n" +
                    "\t\t\t\t\t\t\t\t\t\t</div>\n" +
                    "\t\t\t\t\t\t\t\t\t</div>\n" +
                    "\t\t\t\t\t\t\t\t</div>\n" +
                    "\t\t\t\t\t\t\t</div>\n" +
                    "\t\t\t\t\t\t</div>\t";

                $.loadScript(dataTableScriptVendor, function () {

                });

                $.loadScript(dataTableScript, function () {

                });

                $.loadScript(fancyDropDownScript, function () {

                });
                scrollToSectionTop("top-admin-section");

            default:
                break;
        }
        $(".admin-divisions-row").html(divisionDisplay).hide().fadeIn('slow');
    }).done(function () {
        console.log("second success");
    }).fail(function () {
        console.log("error");
    }).always(function () {
        console.log("finished");
    });

}

/**
 * function to load external js scripts dynamically
 * @param url
 * @param callback
 */
jQuery.loadScript = function (url, callback) {
    jQuery.ajax({
        url: url,
        dataType: 'script',
        success: callback,
        async: true
    });
}

/**
 * function that scrolls to the top of the class send as the section parameter
 * @param section
 * @constructor
 */
function scrollToSectionTop(section) {
    $('html,body').animate({
        scrollTop: $("." + section).offset().top
    }, 'slow');
}
