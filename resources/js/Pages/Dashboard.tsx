import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { PageProps } from '@/types';

interface DashboardProps extends PageProps {
    totalJenisBTS: number;
    totalPemilikBTS: number;
    totalMonitoring: number;
    totalWilayahBTS: number;
}

const Dashboard: React.FC<DashboardProps> = ({ auth, totalJenisBTS, totalPemilikBTS, totalWilayahBTS, totalMonitoring }) => {

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">Selamat datang di dashboard!</div>
                    </div>
                </div>
                <p className='max-w-7xl sm:px-6 lg:px-8 mt-6 text-2xl font-thin text-gray-900'>Statistik BTS</p>
                <div className="max-w-7xl grid grid-cols-4 gap-4 sm:px-6 lg:px-8 mt-6">
                    <div className="bg-white py-6 text-gray-900 text-center overflow-hidden shadow-sm sm:rounded-lg">
                        <p className="text-sm font-semibold">Total Jenis BTS</p>
                        <p className="text-3xl font-semibold">{totalJenisBTS}</p>
                    </div>
                    <div className="bg-white py-6 text-gray-900 text-center overflow-hidden shadow-sm sm:rounded-lg">
                        <p className="text-sm font-semibold">Total Pemilik BTS</p>
                        <p className="text-3xl font-semibold">{totalPemilikBTS}</p>
                    </div>
                    <div className="bg-white py-6 text-gray-900 text-center overflow-hidden shadow-sm sm:rounded-lg">
                        <p className="text-sm font-semibold">Total Wilayah BTS</p>
                        <p className="text-3xl font-semibold">{totalWilayahBTS}</p>
                    </div>
                    <div className="bg-white py-6 text-gray-900 text-center overflow-hidden shadow-sm sm:rounded-lg">
                        <p className="text-sm font-semibold">Total Monitoring BTS</p>
                        <p className="text-3xl font-semibold">{totalMonitoring}</p>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

export default Dashboard;
