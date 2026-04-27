// src/routes/AppRouter.jsx
import { BrowserRouter, Routes, Route } from 'react-router-dom'
import ProtectedRoute from './ProtectedRoute'
import AdminRoute from './AdminRoute'

// Public pages
import LandingPage from '../pages/public/LandingPage'
import LoginPage from '../pages/public/LoginPage'
import RegisterPage from '../pages/public/RegisterPage'

// User pages
import DashboardPage from '../pages/user/DashboardPage'
import BookingPage from '../pages/user/BookingPage'
import BookingHistoryPage from '../pages/user/BookingHistoryPage'
import ProfilePage from '../pages/user/ProfilePage'

// Admin pages
import AdminDashboardPage from '../pages/admin/AdminDashboardPage'
import AdminSlotsPage from '../pages/admin/AdminSlotsPage'
import AdminBookingsPage from '../pages/admin/AdminBookingsPage'
import AdminUsersPage from '../pages/admin/AdminUsersPage'

// 404
import NotFoundPage from '../pages/NotFoundPage'

const AppRouter = () => {
  return (
    <BrowserRouter>
      <Routes>

        {/* === PUBLIC ROUTES === */}
        <Route path="/" element={<LandingPage />} />
        <Route path="/login" element={<LoginPage />} />
        <Route path="/register" element={<RegisterPage />} />

        {/* === USER ROUTES (harus login) === */}
        <Route element={<ProtectedRoute />}>
          <Route path="/dashboard" element={<DashboardPage />} />
          <Route path="/booking" element={<BookingPage />} />
          <Route path="/booking/history" element={<BookingHistoryPage />} />
          <Route path="/profile" element={<ProfilePage />} />
        </Route>

        {/* === ADMIN ROUTES (harus login + role admin) === */}
        <Route element={<AdminRoute />}>
          <Route path="/admin" element={<AdminDashboardPage />} />
          <Route path="/admin/slots" element={<AdminSlotsPage />} />
          <Route path="/admin/bookings" element={<AdminBookingsPage />} />
          <Route path="/admin/users" element={<AdminUsersPage />} />
        </Route>

        {/* === 404 === */}
        <Route path="*" element={<NotFoundPage />} />

      </Routes>
    </BrowserRouter>
  )
}

export default AppRouter