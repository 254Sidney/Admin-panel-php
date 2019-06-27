<h1>PHP Dynamic Admin Panel</h1>

Contents:

Introduction	
  Browser Requirements	
  
  Installation	
  
  Configuration	
  
  <h1>Introduction</h1>
  

The PHP Admin panel (PAP) is a free open source project bullied for PHP developer in order to reduce time and efforts during development cycle  

This Version counted as V 0 which mean that you can modify and customize as what fits you and feel free to update us with any suggestion or enhancement. 

<h3>Browser Requirements </h3>

    •	PHP 7.0.0
    •	mysql
  
  The Admin Panel will work with the following browsers: 
  
    •	Chrome
  
    •	Firefox
  
    •	Edge 


<h3>Installation </h3>

    1- Download the repository PAP app and extract it in your main project directory  
    2- Access PAP directory throw your project URL  
    
<h3> Configuration</h3>

    1.	Data base connection settings 
        You need to provide
           •	A host name
           •	Data Base name 
           •	Data base user name 
           •	Data base user password
           
   <img src="https://github.com/alialroomi/dynamic-php7-admin-cms/blob/master/readmeimages/database-connection.png" width="800px" height="500px"/>
   
   
    2.	Foreign key 
      You need to define the foreign keys and the display names 
 
 <img src="https://github.com/alialroomi/dynamic-php7-admin-cms/blob/master/readmeimages/selectthedisplaynameforforigenkeys.png" width="800px" height="500px" />
 
    3.	Settings (Image, Video) :
      Fieldname_Image is the default value to handle the Images uploading
      (physically exist in default bath\PAP\Admin\authentication\uploads) 
      
      Images has default settings :
          •	Blob datatype (varchar and text are considered as blob, make sure the image field is not type of text)
              is handled as images upload (image link isn't physical exist).
          •	Fieldname_Image is default value to handled images upload 
              (physical exist in default path (uploads/) folder)
          •	If you want to change the default (uploads/) directory please define it down.
          
      Videos has default settings :
          •	Fieldname_Youtube or fieldname_youtube are handled as YouTube embedded 
              (physical is not existing on your own media server).
          •	fieldname_Viedo or fieldname_viedo are handled as media server, that you upload at 
              (default define as fieldname_Viedo or        fieldname_Viedo)
          •	if you want to change the default fieldname_Viedo please define it down.

          
 <img src="https://github.com/alialroomi/dynamic-php7-admin-cms/blob/master/readmeimages/imagesandvideo.png" width="800px" height="500px"/>
 
 
      4. Settings (Password fields) :
          The default value is Filedname_Password (make sure to contain password word in your table structure) 
              otherwise you can define it in the specific fields .
              
   <img src="https://github.com/alialroomi/dynamic-php7-admin-cms/blob/master/readmeimages/passwordfield.png" width="800px" height="500px"/>
   
           
     5. Statistical configuration :
        If you want to make any statistical chart for any table just make sure to select it .
        
   <img src="https://github.com/alialroomi/dynamic-php7-admin-cms/blob/master/readmeimages/statistics.png" width="800px" height="500px"/>
   
   
   
     6. Define user table to access PAP admin panel :
        You must have at least one pre-defined use to logoin in the same users table , that you select and the 
         data type of password field is SH1 .
         
  <img src="https://github.com/alialroomi/dynamic-php7-admin-cms/blob/master/readmeimages/definetheadminuserlogoin.png" width="800px" height="500px"/>     
     
     
      7.Define the Project name :
   <img src="https://github.com/alialroomi/dynamic-php7-admin-cms/blob/master/readmeimages/defineprojectname.png" width="800px" height="500px"/>         
   
      
      
 After following all the configuration steps, you will be able to login the PAP :
 
  <img src="https://github.com/alialroomi/dynamic-php7-admin-cms/blob/master/readmeimages/logintopap.png" width="800px" height="500px"/>         
   
   
   
   
   
   <h3> For any inquiry please contact me direct to the below contacts or just leave a coment </h3>
   <h4> Developed  By - Ali Alroomi</h3>
   <h4> mobile: 00962799279272</h4>
   <a href="mailto:alialroomi2009@gmail.com" > email: alialroomi2009@gmail.com</a>
   
   
   
   
   
   
   
   
   
   
   
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
