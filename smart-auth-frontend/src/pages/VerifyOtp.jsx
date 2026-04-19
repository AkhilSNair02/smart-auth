import { useState } from 'react';
import { useLocation, useNavigate } from 'react-router-dom';
import api from '../api/axiosInstance';

export default function VerifyOtp() {
  const { state } = useLocation();
  const navigate  = useNavigate();
  const email     = state?.email || '';
  const [otp, setOtp] = useState('');
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  const [loading, setLoading] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError('');
    setLoading(true);
    try {
      await api.post('/auth/verify-otp', { email, otp });
      setSuccess('Account verified! Redirecting to login…');
      setTimeout(() => navigate('/login'), 1800);
    } catch (err) {
      setError(err.response?.data?.message || 'Verification failed.');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-purple-50 flex items-center justify-center p-4">
      <div className="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 text-center">
        <div className="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-6">
          <span className="text-3xl">📬</span>
        </div>
        <h1 className="text-2xl font-bold text-gray-900">Check Your Email</h1>
        <p className="text-gray-500 mt-2 mb-6">We sent a 6-digit OTP to <strong>{email}</strong></p>
        {error && <div className="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm">{error}</div>}
        {success && <div className="mb-4 p-3 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">{success}</div>}
        <form onSubmit={handleSubmit} className="space-y-4">
          <input type="text" value={otp} onChange={(e) => setOtp(e.target.value)} maxLength={6} required
            className="w-full px-4 py-3 border border-gray-300 rounded-lg text-center text-2xl tracking-[0.5em] font-bold focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
            placeholder="000000" />
          <button type="submit" disabled={loading}
            className="w-full py-3 bg-indigo-600 hover:bg-indigo-700 disabled:opacity-60 text-white font-semibold rounded-lg transition">
            {loading ? 'Verifying…' : 'Verify OTP'}
          </button>
        </form>
      </div>
    </div>
  );
}