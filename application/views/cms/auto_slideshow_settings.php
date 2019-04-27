

<?php
$image_urls = [];
$this->db->where('node_id', $node_id);
$query = $this->db->get('slides');
if ($query->num_rows() > 0) {
    foreach ($query->result() as $row) {
        if ($row->seq_num == 0)
            $audio_url = base_url().$row->media_uri;
        else {
            $image_urls[$row->seq_num] = base_url().$row->media_uri;

        }

    }
    ksort($image_urls);
}
$image_num = count($image_urls);
echo $error;
?>
<script>


    function errorHandling(){

        var times = [];
        var totalImages = <?php echo $image_num?>;
        var error = document.querySelector('error-text');
        var flag = true;
        var noError = true;

        for (entryNum = 1; entryNum<totalImages; entryNum++){ //loop through the number of timestamps


            let curMin = document.getElementById("min" + entryNum).value;
            let curSec = document.getElementById("sec" + entryNum).value;




            if (curMin=="" || curSec==""){
                document.getElementById("error-text").innerHTML = "Error: Please fill in all the timestamps";
                flag = false;
                return flag;
            }
            curMin = parseFloat(curMin); //making the input text a number
            curSec = parseFloat(curSec);
            let curTime = curMin*60 + curSec;
            if (!Number.isInteger(curMin) || !Number.isInteger(curSec) ) { //if the current min or sec not integers
                document.getElementById("error-text").innerHTML = "Error: All the timestamps must be integers in minutes and seconds";
                flag = false;
                return flag;
              } else if(curTime<0){
                document.getElementById("error-text").innerHTML = "Error: You cannot have any timestamps at 00:00";
                flag = false;
                return flag;
              } else if(curSec<0 || curSec>59){
                document.getElementById("error-text").innerHTML = "Error: All the seconds must be integers between 0 and 59";
                flag = false;
                return flag;

            }
            times.push(curTime);
        }

        for(let index=0; index<times.length-1; index++){
            console.log(noError);


            if (times[index] >= times[index+1] && noError){ //if the times are not in increasing order
                noError = false;
                document.getElementById("error-text").innerHTML = "Error: Your timestamps are not in increasing order."+"<br>"
                    + "Remember that each timestamp must be at least one second more than the previous one." + "<br>"
                    +"If you wish to change the order of your images, click "
                    + "<a href='<?php echo base_url().'cms/slide/'.$tour_id.'/'.$node_id;?>/1'>" +" here " + "</a>";

                flag = false;
                return flag;

            }

        }

        return flag;
    }


</script>
<br>
<br>



<?php if(isset($audio_url)&& $image_num>=2):?>

    <audio id="player" src="<?php echo $audio_url?>"></audio>


    <div class="row">
        <div class="small-12 medium-12 large-12 columns small-centered medium-centered large-centered">
            <p>Please enter the time in the audio file that the tour narrator
                starts talking about the image in each of the boxes below. The time should be entered in minutes and seconds, where the
                left box under each image represents minutes and the right box represents seconds.
                The times that you enter should increase from left to right for each image, so make sure all of your images are in the correct
                order before you start this process.</p>
            <p> <b>Note:</b> You cannot enter a timestamp for the first image because the first image will
                appear at 00:00.</p>
        </div>
    </div>

    <div>
        <audio controls onplay="audio()" style="margin: 0 auto; display: block">
        <source src="<?php echo $audio_url?>" type="audio/mpeg">
        Your browser does not support the audio tag.
        </audio>
    </div>



    <br><div class="row">
        <p id="error-text" class="text-center" style='color:#D8000C; font-weight:bold; font-style:italic; margin-bottom:0;'></p>
    </div>


    <form action = "<?php echo base_url().'cms/auto-slideshow-settings/'.$tour_id.'/'.$node_id.'/send-form';?>" onsubmit="return errorHandling()" method="POST">
        <?php
        $input_num = 0;

        echo "<div style='  flex-wrap: wrap; display: flex; justify-content: center;'>";
        foreach ($image_urls as $image_url){
            echo "  <div id='image$input_num' style=' class=thumb-holder; display:inline-block; position:relative;
                            margin: 30px 20px; width: 300px height: 300px '>";
            echo "    <img src='$image_url' class='slide' style=' height:100px; width: 100px; 
                             vertical-align:top'>";
            if ($input_num!=0){ //so you can't change time of first image
                echo "    <input type='text' value='00' maxlength='2' id='min$input_num' name='min$input_num'
                            style=' width: 35px; 
                            position: absolute; left:10%; top:110% '>";
                echo "<div style='position: absolute; left:47.5%; top:120%; font-weight:bold;'>:</div> ";
                echo "    <input type='text' value='00' maxlength='2' id='sec$input_num' name='sec$input_num'
                            style=' width: 35px; 
                            position: absolute; left:55%; top:110% '>";
            }
            echo "  </div>";
            $input_num+= 1;
        }

        echo "</div>";
        ?>
        <br>
        <br>
        <br>
        <div style="display-flex; justify-content: center;">
            <input type="submit" onclick="errorHandling()" id="submit-button"
                   value="Submit Timestamps" class="tiny button" style="margin: 0 auto; display: block">
        </div>
        <br>
        <br>
        <p style="text-align:center"><a
              href="<?php echo base_url().'cms/node/'.$tour_id.'/'.$node_id;?>">Back to the upload page</a></p>



    </form>
<?php else: ?>
<div class="row">
    <p class="small-12 medium-12 large-12 columns small-centered medium-centered large-centered">
        Whoops! You need to upload an audio file and at least two images to use the Automatic Slideshow
        Feature. Click <a href="<?php echo base_url().'cms/node/'.$tour_id.'/'.$node_id;?>">here</a> to go back and
        upload these files.
    </p>
</div>

<?php endif;?>



