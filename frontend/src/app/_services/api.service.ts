import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import { environment } from '../../environments/environment';


export class ApiService {
    public token: string;
    private headers: HttpHeaders;
    private readonly apiUrl = environment.apiUrl;
    private readonly baseUrl = environment.baseUrl;

    constructor(private http: HttpClient) {
        //append headers
        this.headers = new HttpHeaders();
        this.headers.append("Content-Type", 'application/json');
        this.headers.append("Access-Control-Allow-Origin", "*");
        this.headers.append("Access-Control-Allow-Headers", "Origin, Authorization, Content-Type, Accept");
        
        // set token if saved in local storage
        var currentUser = JSON.parse(localStorage.getItem('user'));
        this.token = currentUser && currentUser.token;
    }

    allannouncement(): Observable<any> {
        return this.http.post('http://uat.mahindrarise.com/api/SpotLight/announcement', { }, { headers: this.headers } )
            .pipe(
                map((response: Response) => {

                //console.log(response);
                    // login successful if there's a jwt token in the response
                    //this.token = response['token'];
                    //let email = response['email'];
                   // if (this.token) {
                        // store email and jwt token in local storage to keep user logged in between page refreshes
                       // localStorage.setItem('user', 
                         //   JSON.stringify({ email: email, token: this.token }));
                    //}
                    return response;
                })
            );
    }

    

}