<!-- HTML for static distribution bundle build -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title> {{env("APP_NAME", "lumen")}} | Swagger UI</title>
    <link rel="stylesheet" type="text/css" href="{{ url("assets/css/swagger-ui.css") }}" >
    <link rel="icon" type="image/png" href="{{ url("assets/img/favicon-32x32.png") }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ url("assets/img/favicon-16x16.png") }}" sizes="16x16" />
    <style>
      html
      {
        box-sizing: border-box;
        overflow: -moz-scrollbars-vertical;
        overflow-y: scroll;
      }
      *,
      *:before,
      *:after
      {
        box-sizing: inherit;
      }

      body
      {
        margin:0;
        background: #fafafa;
      }
    </style>
  </head>
  <body>
    <div id="swagger-ui"></div>
    <script src="https://unpkg.com/swagger-ui-dist@4.14.0/swagger-ui-standalone-preset.js"></script>
    <script src="https://unpkg.com/swagger-ui-dist@4.14.0/swagger-ui-bundle.js"></script>
    <script>
    window.onload = function() {
      // Begin Swagger UI call region
      const ui = SwaggerUIBundle({
        url: "{{ url("assets/apispec.json") }}",
        dom_id: '#swagger-ui',
        validatorUrl : null,
        deepLinking: true,
        presets: [
            SwaggerUIBundle.presets.apis,
            SwaggerUIStandalonePreset
        ],
        layout: "StandaloneLayout",
        //Checks any reponse obtained for an access token
        responseInterceptor: (responseObj) => {
          if("access_token" in responseObj.obj){
            window.token = responseObj.obj.access_token;
          }
          return responseObj
        },

        //Adds the authorization to the request header if token has been set
        requestInterceptor: (requestObj) => {
          if(window.token) {
            requestObj.headers.Authorization = `Bearer ${window.token}`;
          }
          return requestObj
        }
      })
      // End Swagger UI call region
      window.ui = ui
    }
  </script>
  </body>
</html>