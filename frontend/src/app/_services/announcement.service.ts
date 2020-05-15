import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import { environment } from '../../environments/environment';

@Injectable()
export class AnnouncementService {
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

    allproducts(): Observable<any> {
        return this.http.get(this.apiUrl+'user/products', { headers: this.headers } )
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

    allproductscart(): Observable<any> {
        return this.http.post(this.apiUrl+'user/productscart',  {'user':localStorage.getItem("user")},{ headers: this.headers } )
            .pipe(
                map((response: Response) => {

                    return response;
                })
            );
    }


    buyproduct(id): Observable<any> {

            console.log(localStorage.getItem("user"));
            return this.http.post(this.apiUrl+'user/buyproducts',
                { product: id,'user':localStorage.getItem("user")},  { headers: this.headers } )
                .pipe(
                    map((response: Response) => {
                        return response;
                    })
                );
    }

    removeorder(id): Observable<any> {

            console.log(localStorage.getItem("user"));
            return this.http.post(this.apiUrl+'user/removeorder',
                { product: id,'user':localStorage.getItem("user")},  { headers: this.headers } )
                .pipe(
                    map((response: Response) => {
                        return response;
                    })
                );
    }

     checkout(): Observable<any> {

       
            return this.http.post(this.apiUrl+'user/checkout',
                { 'user':localStorage.getItem("user")},  { headers: this.headers } )
                .pipe(
                    map((response: Response) => {
                        return response;
                    })
                );
    }
    

    

}