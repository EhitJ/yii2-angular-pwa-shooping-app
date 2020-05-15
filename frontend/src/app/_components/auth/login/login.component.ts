import {Component, NgZone, OnInit} from '@angular/core';
import { AuthenticationService } from '../../../_services/authentication.service';
import {Router} from '@angular/router';
import { FormsModule } from '@angular/forms';
import { HttpHeaders } from '@angular/common/http';




@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})

export class LoginComponent implements OnInit {

  public  email: string = '';
  public password: string = '';
  public warningMessage: string;
  public loggedIn: boolean;
  private  child: any;
  private  timer: any;

  constructor(private authServiceLogin: AuthenticationService, private router: Router,private zone: NgZone) {
  }

  ngOnInit() {
    
          
     
  }
    

    onLogIn() {


    this.authServiceLogin.login(this.email, this.password)
    .subscribe(res => {
      //check for errors
      this.warningMessage = '';

      if(res['success'] == '0'){
        this.warningMessage = "Invalid Credentials!";
      }
      if(Array.isArray(res)) {
        this.warningMessage += res[0];

      }

        console.log(this.warningMessage);
      // if not errors - navigate to home
      if(!this.warningMessage) {
          this.authServiceLogin.loggedIn = true;
          console.log("Value IS "+this.authServiceLogin.loggedIn );
         // this.router.navigate(['home']);
          this.zone.run(() => {
              //this.authServiceLogin.setLoggedIncount('1');
              console.log("Login COunt : ",this.authServiceLogin.loggedIncount);
              this.router.navigate(['/home']);

          });
      }

    }, error => {
      this.warningMessage = "Invalid Credentials!";
      console.error(error);
    } );
  }

}
