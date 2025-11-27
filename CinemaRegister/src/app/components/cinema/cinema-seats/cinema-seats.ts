import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { CommonModule } from '@angular/common';

export interface Seat {
  id: number;
  codigo: string;   
  status: 'livre' | 'ocupado' | string;
}

@Component({
  selector: 'cinema-seats',
  templateUrl: './cinema-seats.html',
  imports: [CommonModule],
  styleUrls: ['./cinema-seats.css']
})
export class CinemaSeatsComponent implements OnInit {

  seats: Seat[] = [];

  constructor(private http: HttpClient) {}

  ngOnInit() {
    this.loadSeats();
  }

  loadSeats() {
    this.http.get<Seat[]>(
      'http://localhost/projeto-registro-evento/projeto-php/getSeats.php',
      { withCredentials: true }
    ).subscribe(res => {
      this.seats = res;
    }, err => {
      if (err.status === 401) {
        alert("Você precisa estar logado!");
      }
    });
  }

  reserveSeat(seat: Seat) {
    if (seat.status === 'ocupado') return;

    this.http.put(
      'http://localhost/projeto-registro-evento/projeto-php/reserve-seat.php',
      { seat_id: seat.id },
      { withCredentials: true }
    ).subscribe((res: any) => {
      if (res.status === "ok") {
        seat.status = 'ocupado';
      }
      alert(res.msg || "");
    }, err => {
      if (err.status === 401) {
        alert("Você precisa estar logado!");
      }
    });
  }
}
