/* 
*  Copyright (c) Microsoft. All rights reserved. Licensed under the MIT license. 
*  See LICENSE in the source repository root for complete license information. 
*/

import { Injectable } from '@angular/core';
import { Headers } from '@angular/http';

@Injectable()
export class HttpService {
  getAccessToken() {
   // const msft = hello('msft').getAuthResponse();
    const accessToken = '';//msft.access_token;
    return accessToken;
  }

  login(){
  // return hello().login();
  }
}
