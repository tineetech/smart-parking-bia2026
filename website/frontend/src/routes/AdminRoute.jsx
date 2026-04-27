// src/routes/AdminRoute.jsx
import { Navigate, Outlet } from 'react-router-dom'
import useAuthStore from '../store/authStore'

const AdminRoute = () => {
  const { token, role } = useAuthStore()

  if (!token) {
    return <Navigate to="/login" replace />
  }

  if (role !== 'admin') {
    return <Navigate to="/dashboard" replace />
  }

  return <Outlet />
}

export default AdminRoute