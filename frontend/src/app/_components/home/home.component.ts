import { Component, OnInit } from '@angular/core';
import { AnnouncementService } from '../../_services/announcement.service';
import {Router} from '@angular/router';



@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {


  public warningMessage: string;
  public imagepath : string;
  public displayedColumns: string[] = ['srno','title', 'description', 'price', 'image_path','id'];
  public dataSource: string = '';
  constructor(private authService: AnnouncementService, private router: Router) { 
  //this.imagepath=this.imageUrl;
  }

  ngOnInit() {

  	this.authService.allproducts()
	    .subscribe(res => {
	   		this.dataSource=res;
       
	    }, error => {
	      this.warningMessage = "Something Went wrong";
	    } );
  }


  buyproduct(id) {


    this.authService.buyproduct(id)
    .subscribe(res => {
      //check for errors
      this.warningMessage = '';
      this.warningMessage = res.payload;
      setTimeout(()=>{   
          this.warningMessage = '';
      }, 1000);

    }, error => {
      this.warningMessage = "Something Went wrong";
    } );
  }
 

}
