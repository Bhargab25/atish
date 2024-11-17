<?php
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$asset = ASSET_MODEL::ReadAll(); 
?>
<table id="example1" class="table table-bordered table-hover">
                <thead>
                    
                <tr>
                   <th style="width: 10px">#</th>
                  <th>Asset Name</th>
				  <th>Serial Number</th>
                  <th style="width: 40px">View</th>
				  <th style="width: 40px">Edit</th>
                </tr>
                </thead>
                <tbody>
				 <?php 
                    $i=1;
                    foreach($asset as $ast){ ?>
				<tr>
                 <td><?php echo $i; ?></td>
                  <td><?php echo $ast->NAME; ?></td>
				  <td><?php echo $ast->MACID; ?></td>
                  <td style="text-align: center; font-size: 16px;"><i class="fa fa-fw fa-eye"></i></td>
				  <td style="text-align: center; font-size: 16px;"><i class="fa fa-fw fa-cog"></i></td>
                </tr>  
				<?php
$i++;
				}
				?>
				</tbody>
                <tfoot>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Asset Name</th>
				  <th>Serial Number</th>
                  <th style="width: 40px">View</th>
				  <th style="width: 40px">Edit</th>
                </tr>
                </tfoot>
              </table>