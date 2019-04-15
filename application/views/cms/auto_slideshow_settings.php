<?php
$image_urls = [];
$this->db->where('node_id', $node_id);
$query = $this->db->get('slides');
if ($query->num_rows() > 0) {
    foreach ($query->result() as $row) {
        if ($row->seq_num == 0)
            $audio_url = base_url().$row->media_uri;
        else {
            array_push($image_urls,base_url().$row->media_uri);
        }

    }
}
?>
<audio controls style="max-width: 90%;">
    <source src="<?php echo $audio_url?>" type="audio/mpeg">
    Your browser does not support the audio tag.
</audio>
<form action = "<?php echo base_url();?>media/js/Slideshow2.js" method="POST">
    <?php
    foreach ($image_urls as $image_url){
        echo "<img src='$image_url' style='height:100px; width: 100px; display: block'>";
        echo "<input type='text' name='timestamps' style='width: 200px; margin: 0 auto'>";
    }
    ?>



</form>
