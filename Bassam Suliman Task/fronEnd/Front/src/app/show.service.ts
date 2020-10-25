import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http'
import {Observable, observable} from 'rxjs'

@Injectable({
  providedIn: 'root'
})
export class ShowService {
  readonly APIUrl="https://reqres.in/api/";

  constructor(private http:HttpClient) { }
  showPage(val:any):Observable<any[]>{
       return this.http.get<any>(this.APIUrl+'users?page='+ val)
  }

  showUser_Details(val:any):Observable<any[]>{
    return this.http.get<any>(this.APIUrl+'users/'+ val)
}
}
