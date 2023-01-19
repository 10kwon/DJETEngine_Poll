<?php
$classpath = dirname(__FILE__).parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
//if classpath includes node_modules
if (strpos($classpath, 'node_modules') !== false or strpos($classpath, 'vendor') !== false or strpos($classpath, "package.json") !== false or strpos($classpath, "package-lock.json") !== false or strpos($classpath, "tailwind.config.js") !== false or strpos($classpath, "input.css") !== false) {
    echo '<html><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>403 - Access Denied</title>
  </head>
  <body>
    
  <!-- Page Container -->
  <div class="flex items-center justify-center min-h-screen bg-white py-48">
      <div class="flex flex-col">
          <!-- Notes -->
          <!-- Error Container -->
          <div class="flex flex-col items-center">
              <svg class="text-red-500 w-32 h-32 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
  
              <div class="text-red-500 font-bold text-7xl">
                  403
              </div>
  
              <div class="font-bold text-3xl xl:text-7xl lg:text-6xl md:text-5xl mt-10">
                  Access Denied
              </div>
  
              <div class="text-gray-400 font-medium text-sm md:text-xl lg:text-2xl mt-8">
                  찾으시는 페이지를 접근할 권한이 없습니다.<br>
                  Page you are looking for is not available.
              </div>
          </div>
  <a href="/" class="mt-16 w-2/3 bg-blue-500 text-white text-center rounded-lg shadow-lg m-auto py-2 text-xl font-bold">
  홈으로 (To Home)
  </a>
   
          </div>
      </div>
  
  
  
  </body></html>';
}
else if ( file_exists($classpath)) {
    
    header("HTTP/1.1 200 OK");
    if (pathinfo($classpath)['extension'] == "php") {
        include $classpath;
         }
else if (pathinfo($classpath)['extension'] == "css") {
 header( 'Content-Type:text/css;charset=utf-8 '); 
        readfile($classpath);
}
      else {
        header( 'Content-Type:'.mime_content_type($classpath).';charset=utf-8 '); 
        readfile($classpath);
    }
	} 	
   else{
    //pick random number from 0 to 1
    $random_DASI = rand(1,2);
    //if random number is 0
    if ($random_DASI == 1){
        $DASISuffix = "";
    }
    else{
        $DASISuffix = "-2";
    }
      echo '<html><head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
      <title>404 - Not Found</title>
    </head>
    <body>
      
    <!-- Page Container -->
    <div class="flex items-center justify-center min-h-screen bg-white py-48">
        <div class="flex flex-col">
            <!-- Notes -->
            <!-- Error Container -->
            <div class="flex flex-col items-center">
                <img src="https://injeonmetro.co.kr/resources/images/DASI-404'.$DASISuffix.'.png" alt="404" class="h-32">
                
                <div class="text-red-500 font-bold text-7xl">
                    404
                </div>
    
                <div class="text-3xl xl:text-7xl lg:text-6xl md:text-5xl">
                    Not Found
                </div>
    
                <div class="text-gray-400 font-medium text-sm md:text-xl lg:text-2xl mt-8">
                    찾으시는 페이지가 존재하지 않습니다.
                </div>
            </div>
    <a href="/" class="mt-16 w-2/3 bg-blue-500 text-white text-center rounded-lg shadow-lg m-auto py-2 text-xl font-bold">
    홈으로
    </a>
    <a href="javascript:location.reload()" class="mt-4 w-2/3 bg-gray-500 text-white text-center rounded-lg shadow-lg m-auto py-2 text-xl font-bold">
    다른 \'다시\' 보기
    </a>
     
            </div>
        </div>
    
    
    
    </body></html>';

}
?>
