export interface User { id: number; name: string; email: string; role_id?: number; status?: boolean; }
export interface LoginResponse { user: User; token: string; }
