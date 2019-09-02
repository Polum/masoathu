$(function () {

    var chartData = {};  
    $.get(link,(data, status)=>{
        let response = [];
        let pg_title = '';
        switch (page) {
            case 'candidates':
                response = data.data;
                break;
            case 'district':
                response = data.data.candidates;
                pg_title = data.data.name+' DISTRICT';
                break;
            case 'districts':
                response = data.data;
                pg_title = 'ALL DISTRICTS';
                break;
            case 'constituency':
                response = data.data.candidates;
                pg_title = data.data.name+' CONSTITUENCY';
                break;
            case 'ward':
                response = data.data.candidates;
                pg_title = data.data.name+' WARD';
                break;
        
            default:
                break;
        }
        // console.log(response);
        //loop through
        if(pg_title != ''){
            $('.pg_title').html(pg_title);
        }

        $.each(response, function(index, value){
            chartData[value.name] = value.results;
            let runningMate = value.runningmate_name? value.runningmate_name: '-';

            if(page === 'candidates'){
                //add table
                $('#candidates_table tbody')
                .append(
                    `<tr>
                        <th scope="row">`+(index+1)+`</th>
                        <td>`+value.name+`</td>
                        <td>`+runningMate+`</td>
                        <td>`+value.party_name+`</td>
                        <td>`+value.results+`</td> 
                        <td> <a href="`+baseUrl+`/candidate/`+value.id+`" type="button" class="btn btn-primary btn-sm">View Candidate Results</a></td>
                    </tr>`
                );
            }
            else{
                
            }
        });

        chartInit(chartData);
        
    }).fail((err)=>{
        console.log(err);
    });

    
});

function chartInit(chartData){
    var cc = echarts.init(document.getElementById('cc'));
    cc_options = barTemplate(chartData, {x: 40,x2: 40,y: 5,y2: 120}, '#006180');
    cc.setOption(cc_options);
}