import { Component, OnInit } from '@angular/core';
import { AnnouncementService } from '../../_services/announcement.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent implements OnInit {
  public warningMessage: string;
  public imagepath : string;
  public displayedColumns: string[] = ['srno','title', 'description', 'price', 'image_path','id'];
  public dataSource: string = '';
    constructor(private authService: AnnouncementService, private router: Router) { 
	  //this.imagepath=this.imageUrl;
	  }

  ngOnInit() {
  		this.authService.allproductscart()
	    .subscribe(res => {
	   		this.dataSource=res;
       
	    }, error => {
	      this.warningMessage = "Something Went wrong";
	      
	    } );
  }

  checkout() {


    this.authService.checkout()
    .subscribe(res => {
      //check for errors
      console.log(res);
      this.warningMessage = '';
      this.warningMessage = res.payload;
      setTimeout(()=>{   
          location.reload();
      }, 1000);

    }, error => {
      this.warningMessage = "Something Went wrong";
     // console.error(error);
    } );
  }

  removeorder(id) {


    this.authService.removeorder(id)
    .subscribe(res => {
      //check for errors
      console.log(res);
      this.warningMessage = '';
      this.warningMessage = res.payload;
      setTimeout(()=>{   
          this.warningMessage = '';
          location.reload();
      }, 1000);

    }, error => {
      this.warningMessage = "Something Went wrong";
     // console.error(error);
    } );
  }

}
