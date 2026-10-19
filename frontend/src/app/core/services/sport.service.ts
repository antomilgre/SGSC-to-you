import { HttpClient, HttpParams } from '@angular/common/http';
import { Injectable, inject } from '@angular/core';
import { environment } from '../../../environments/environment';

export interface Sport {
  id: number;
  name: string;
  description?: string | null;
  status: boolean | number;
  teams?: unknown[];
  created_at: string;
}

export interface PaginatedSports {
  data: Sport[];
  current_page: number;
  last_page: number;
  total: number;
  from: number | null;
  to: number | null;
}

interface ApiResponse<T> {
  status: boolean;
  data: T;
}

@Injectable({ providedIn: 'root' })
export class SportService {
  private readonly http = inject(HttpClient);

  list(page = 1) {
    const params = new HttpParams()
      .set('page', page)
      .set('per_page', 10)
      .set('sort_by', 'name')
      .set('sort_order', 'asc');

    return this.http.get<ApiResponse<PaginatedSports>>(`${environment.apiBaseUrl}/sports`, { params });
  }
}
