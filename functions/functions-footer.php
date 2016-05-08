<?php

/* --------------------------------------------------------------------------------------- Footer Widget Colummn Function */

function function_footer_widget_areas(){ 
 ?> <div class="container">
 	<div class="row"><?php
 	
 	$mt_columns = get_option("themename_theme_options");
				if ($mt_columns['footer_columns'] == '1_1') {  ?>
                    
						<div class="col-md-12">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-1' ); ?>
                        
                        </div>
                    
                <?php 
                
                } 
                
                else if ($mt_columns['footer_columns'] == "1_2") { ?>
                
                        <div class="col-md-6">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-1' ); ?>
                        
                        </div>
                        
                        <div class="col-md-6">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-2' ); ?>
                            
                        </div>
                    
                <?php 
                
                }
                
                else if ($mt_columns['footer_columns'] == '1_3') { ?>
                    
                        <div class="col-md-4">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-1' ); ?>
                        
                        </div>
                        
                        <div class="col-md-4">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-2' ); ?>
                            
                        </div>
                        
                        <div class="col-md-4">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-3' ); ?>
                            
                        </div>
                    
                <?php 
                
                }
                
                else if ($mt_columns['footer_columns'] == '1_4') { ?>
                    
                        <div class="col-md-3">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-1' ); ?>
                            
                        </div>
                        
                        <div class="col-md-3">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-2' ); ?>
                            
                        </div>
                        
                        <div class="col-md-3">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-3' ); ?>
                            
                        </div>
                        
                        <div class="col-md-3">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-4' ); ?>
                            
                        </div>
                        
                <?php 
                
                }
                
                else if ($mt_columns['footer_columns'] == '1_5') { ?>
                    
                        <div class="one_fifth">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-1' ); ?>
                            
                        </div>
                        
                        <div class="one_fifth">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-2' ); ?>
                            
                        </div>
                        
                        <div class="one_fifth">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-3' ); ?>
                            
                        </div>
                        
                        <div class="one_fifth">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-4' ); ?>
                            
                        </div>
                        
                        <div class="one_fifth last">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-5' ); ?>
                            
                        </div>
                        
                <?php 
                
                }
                
                else if ($mt_columns['footer_columns'] == '1_6') { ?>
                
                        <div class="col-md-2">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-1' ); ?>
                            
                        </div>
                        
                        <div class="col-md-2">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-2' ); ?>
                            
                        </div>
                        
                        <div class="col-md-2">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-3' ); ?>
                            
                        </div>
                        
                        <div class="col-md-2">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-4' ); ?>
                            
                        </div>
                        
                        <div class="col-md-2">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-5' ); ?>
                            
                        </div>
                        
                        <div class="col-md-2">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-6' ); ?>
                            
                        </div>
                        
                <?php 
                
                }
                
                else if ($mt_columns['footer_columns'] == '4_2') { ?>
                    
                        <div class="col-md-3">
                            
                            <?php dynamic_sidebar( 'footer-midle-column-1' ); ?>
                    
                        </div>
                        
                        <div class="col-md-3">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-2' ); ?>
                                  
                        </div>
                        
                        <div class="col-md-6">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-3' ); ?>
                            
                        </div>
                    
                <?php 
                
                }
                
                else if ($mt_columns['footer_columns'] == '2_6_6_6') { ?>
                    
                        <div class="col-md-6">
                        
                             <?php dynamic_sidebar( 'footer-midle-column-1' ); ?>    
                        
                        </div>
                        
                        <div class="col-md-2">
                
                            <?php dynamic_sidebar( 'footer-midle-column-2' ); ?>
                    
                        </div>
                        
                        <div class="col-md-2">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-3' ); ?>
                            
                        </div>
                        
                        <div class="col-md-2">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-4' ); ?>
                            
                        </div>
                   
                <?php 
                
                }
                
                else if ($mt_columns['footer_columns'] == '2_4') { ?>
                    
                        <div class="col-md-6">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-1' ); ?>
                        
                        </div>
                        
                        <div class="col-md-3">
                    
                            <?php dynamic_sidebar( 'footer-midle-column-2' ); ?>
                    
                        </div>
                        
                        <div class="col-md-3">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-3' ); ?>
                            
                        </div>
                       
                <?php 
                
                }
                
                else if ($mt_columns['footer_columns'] == '6_6_6_2') { ?>
                    
                        <div class="col-md-2">
                
                            <?php dynamic_sidebar( 'footer-midle-column-1' ); ?>
                    
                        </div>
                        
                        <div class="col-md-2">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-2' ); ?>
                            
                        </div>
                        
                        <div class="col-md-2">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-3' ); ?>
                            
                        </div>        
                         
                        <div class="col-md-6">
                        
                            <?php dynamic_sidebar( 'footer-midle-column-4' ); ?>    
                            
                        </div>
                    
                <?php 
                
                }
                
                ?></div></div><?php

}

add_action('function_footer_widget_areas', 'function_footer_widget_areas'); 

?>