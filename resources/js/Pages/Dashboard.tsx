import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import BarChart from '@/Components/BarChart'
import { PageProps } from '@/types';
import OpenStreetMaps from '@/Components/OpenStreetMaps';

interface DashboardProps extends PageProps {
    totalJenisBTS: number;
    totalPemilikBTS: number;
    totalMonitoring: number;
    totalWilayahBTS: number;
    btsPerJenis: any[];
    btsPerWilayah: any[];
    btsPerPemilik: any[];
    lokasiTower: any[];
}

const Dashboard: React.FC<DashboardProps> = ({
     auth, totalJenisBTS, totalPemilikBTS, totalWilayahBTS, totalMonitoring,
     btsPerJenis, btsPerWilayah, btsPerPemilik, lokasiTower
    }) => {

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
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

                <div className='mt-8 px-16'>
                    <OpenStreetMaps coordinates={lokasiTower} zoom={6}/>
                </div>

                <div className="mt-8 px-16">
                    <div className="mb-4 bg-white p-6 rounded-xl flex-col justify-center items-center flex">
                        <h2 className="text-2xl font-bold mb-2">Jumlah BTS Berdasarkan Jenis</h2>
                        <BarChart data={btsPerJenis} title="Jumlah BTS Berdasarkan Jenis" color="#334155"
                                dataKeyX="jenis_bts" dataKeyY="jumlah_bts" height={300}/>
                    </div>
                    <div className="mb-4 bg-white p-6 rounded-xl flex-col justify-center items-center flex">
                        <h2 className="text-2xl font-bold mb-2">Jumlah BTS Berdasarkan Wilayah</h2>
                        <BarChart data={btsPerWilayah} title="Jumlah BTS Berdasarkan Wilayah" color="#334155"
                                dataKeyX="nama_wilayah" dataKeyY="jumlah_bts" height={400}/>
                    </div>
                    <div className="mb-4 bg-white p-6 rounded-xl flex-col justify-center items-center flex">
                        <h2 className="text-2xl font-bold mb-2">Jumlah BTS Berdasarkan Pemilik</h2>
                        <BarChart data={btsPerPemilik} title="Jumlah BTS Berdasarkan Pemilik" color="#334155"
                                dataKeyX="nama_pemilik" dataKeyY="jumlah_bts" height={500}/>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

export default Dashboard;
