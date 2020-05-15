// This file can be replaced during build by using the `fileReplacements` array.
// `ng build --prod` replaces `environment.ts` with `environment.prod.ts`.
// The list of file replacements can be found in `angular.json`.
//http://localhost:4004/api/user/client
export const environment = {
  production: false,
  baseUrl: window.location.origin, // Base URL here
  apiUrl: 'http://localhost:4004/api/', //your local API URL here
  imageUrl :'http://localhost:4003/product/'
};

/*
 * For easier debugging in development mode, you can import the following file
 * to ignore zone related error stack frames such as `zone.run`, `zoneDelegate.invokeTask`.
 *
 * This import should be commented out in production mode because it will have a negative impact
 * on performance if an error is thrown.
 */
// import 'zone.js/dist/zone-error';  // Included with Angular CLI.
