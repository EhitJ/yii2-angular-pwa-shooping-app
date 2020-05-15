import { Component, OnInit } from '@angular/core';
import { AuthenticationService } from '../../_services/authentication.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-navigation',
  templateUrl: './navigation.component.html',
  styleUrls: ['./navigation.component.scss']
})
export class NavigationComponent implements OnInit {
    public loggedIn: boolean;
    public count :number;
  constructor(
  	private authService: AuthenticationService, 
  	private router: Router
  ) {
  this.count=0;
   }

  ngOnInit() {
   
this.loggedIn   =this.authService.isLogin();
  }

  ngAfterViewInit() {
  console.log(this.count);
    this.count=this.count+1;
    console.log(this.count);
  }  


  logout() {
    this.authService.logout();
    this.count=undefined;
    this.router.navigate(['/login']);
    console.log(" THIS IS  "+this.authService.loggedIn);
    this.loggedIn = this.authService.loggedIn;
  }

}
