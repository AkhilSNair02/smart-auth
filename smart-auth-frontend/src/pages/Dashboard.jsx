import { useAuth } from '../context/AuthContext';
import { useNavigate } from 'react-router-dom';

export default function Dashboard() {
  const { user, logout } = useAuth();
  const navigate = useNavigate();

  const handleLogout = async () => {
    await logout();
    navigate('/login');
  };

  return (
    <div className="min-h-screen bg-gray-50">
      <nav className="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between shadow-sm">
        <span className="text-xl font-bold text-indigo-600">SmartAuth</span>
        <button onClick={handleLogout}
          className="px-4 py-2 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition font-medium">
          Logout
        </button>
      </nav>
      <div className="max-w-4xl mx-auto px-6 py-12">
        <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
          <div className="flex items-center gap-4 mb-8">
            <div className="w-16 h-16 rounded-full bg-indigo-100 flex items-center justify-center text-2xl font-bold text-indigo-600">
              {user?.name?.[0]?.toUpperCase()}
            </div>
            <div>
              <h1 className="text-2xl font-bold text-gray-900">Hello, {user?.name}! </h1>
              <p className="text-gray-500 mt-0.5">{user?.email}</p>
            </div>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
            {[
              { label: 'Account Status', value: 'Verified',  bg: 'bg-green-50',  text: 'text-green-700'  },
              { label: 'Auth Method',    value: 'Sanctum',   bg: 'bg-indigo-50', text: 'text-indigo-700' },
              { label: 'Member Since',   value: new Date().toLocaleDateString(), bg: 'bg-purple-50', text: 'text-purple-700' },
            ].map((card) => (
              <div key={card.label} className={`${card.bg} rounded-xl p-5`}>
                <p className="text-sm text-gray-500 font-medium">{card.label}</p>
                <p className={`text-lg font-semibold mt-1 ${card.text}`}>{card.value}</p>
              </div>
            ))}
          </div>
        </div>
      </div>
    </div>
  );
}