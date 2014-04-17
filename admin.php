<link type="text/css" media="all" href="<?php echo plugins_url();?>/npcdirectory/css/bootstrap.min.css" />
<h1>NPC Community Dashboard</h1>
<table class="wp-list-table widefat fixed users">
    <thead>
        <th class="manage-column check-column"></th>
        <th class="manage-column sortable desc">HELLO MATE</th>
    </thead>
    <tfoot></tfoot>
    <tbody>
        <tr>
            <td style="vertical-align: middle;">
                <input type="checkbox" name="users[]" id="user_1" class="administrator" value="1">
            </td>
            <td>
                <h3>Charles I. Essien</h3>
            </td>
        </tr>
    </tbody>
</table>
<?php include dirname( __FILE__ ) . '/register.php';//add_meta_box('main-options','Hey there!','npc_main_options','page');?>

<?php
    function npc_main_options($args){
        echo 'HELLO';
    }
    
?>
