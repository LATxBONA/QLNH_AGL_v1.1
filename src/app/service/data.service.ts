import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { taikhoan } from '../models/taikhoan';

@Injectable({
  providedIn: 'root'
})
export class DataService {
  private API = "http://localhost/project/QLNH_AGL_v1.1/api.php";
  private DATA_JSON = "http://localhost:3000";

  private httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json'
    })
  };
  constructor(private http: HttpClient) { }

  checkAccount(taikhoan: taikhoan): Observable<any> {
      const Username = taikhoan.Username;
      const Password = taikhoan.Password;
      const url = `${this.API}?action=checkAccount&Username=${Username}&Password=${Password}`;
      return this.http.get<any>(url);
    }

  readAccountJson(taikhoan: taikhoan): Observable<any>{
    const url = `${this.DATA_JSON}/taikhoan`;
    return this.http.get<any>(url);
  }
}
