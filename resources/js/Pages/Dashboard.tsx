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
    console.log(totalJenisBTS)

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">You're logged in!</div>
                    </div>
                </div>
                <p className='max-w-7xl sm:px-6 lg:px-8 mt-6 text-2xl font-thin'>Statistik BTS</p>
                <div className="max-w-7xl grid grid-cols-4 gap-4 sm:px-6 lg:px-8">
                    <div className="bg-white py-4 text-gray-900 text-center mt-3 overflow-hidden shadow-sm sm:rounded-lg">
                        <p>Total Jenis BTS</p>
                        <p className=""> {totalJenisBTS}</p>
                    </div>
                    <div className="bg-white py-4 text-gray-900 text-center mt-3 overflow-hidden shadow-sm sm:rounded-lg">
                        <p>Total Pemilik BTS</p>
                        <p className=""> {totalPemilikBTS}</p>
                    </div>
                    <div className="bg-white py-4 text-gray-900 text-center mt-3 overflow-hidden shadow-sm sm:rounded-lg">
                        <p>Total Wilayah BTS</p>
                        <p className=""> {totalWilayahBTS}</p>
                    </div>
                    <div className="bg-white py-4 text-gray-900 text-center mt-3 overflow-hidden shadow-sm sm:rounded-lg">
                        <p>Total Monitoring BTS</p>
                        <p className=""> {totalMonitoring}</p>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

export default Dashboard
