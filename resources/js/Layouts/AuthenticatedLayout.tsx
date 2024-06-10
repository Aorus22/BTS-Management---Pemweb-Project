import { useState, PropsWithChildren, ReactNode } from 'react';
import ApplicationLogo from '@/Components/ApplicationLogo';
import Dropdown from '@/Components/Dropdown';
import NavLink from '@/Components/NavLink';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink';
import { Link } from '@inertiajs/react';
import { User } from '@/types';

export default function Authenticated({ user, header, children }: PropsWithChildren<{ user: User, header?: ReactNode }>) {
    const [showingNavigationDropdown, setShowingNavigationDropdown] = useState(true);

    const toggleDropdown = () => {
        setShowingNavigationDropdown((prev) => !prev);
    };

    const menuItems = [
        {
            title: 'Dashboard',
            route: '/dashboard',
            svg: <img src="/icon/data-bts.svg" alt="Data BTS" />,
        },
        {
            title: 'Jenis BTS',
            route: '/jenis-bts',
            svg: <img src="/icon/data-bts.svg" alt="Data BTS" />,
        },
        {
            title: 'Data BTS',
            route: '/data-bts',
            svg: <img src="/icon/data-bts.svg" alt="Data BTS" />,
        },
        {
            title: 'Data Pemilik',
            route: '/data-pemilik',
            svg: <img src="/icon/data-pemilik.svg" alt="Data Pemilik" />,
        },
        {
            title: 'Data Pengguna',
            route: '/data-pengguna',
            svg: <img src="/icon/data-pengguna.svg" alt="Data Pengguna" />,
        },
        {
            title: 'Data Kuesioner',
            route: '/data-kuesioner',
            svg: <img src="/icon/data-kuesioner.svg" alt="Data Kuesioner" />,
        },
    ];


    return (
        <div className="min-h-screen bg-gray-100 flex">
            <div
                className="bg-white border-r border-gray-200 w-64 flex-shrink-0 flex flex-col fixed left-0 top-0 bottom-0 z-50">
                <div className="flex items-center justify-center h-16 border-b border-gray-200">
                    <Link href="/">
                        <ApplicationLogo className="block h-9 w-auto fill-current text-gray-800"/>
                    </Link>
                </div>
                <nav className="py-4 flex-grow flex flex-col">
                    {menuItems.map((menuItem, index) => (
                        <NavLink key={index} href={menuItem.route} active={route().current(menuItem.route)}>
                            <div className="flex items-center">
                                {/*{menuItem.svg}*/}
                                <span className="ml-2">{menuItem.title}</span>
                            </div>
                        </NavLink>
                    ))}
                </nav>

                <div className="relative">
                    {showingNavigationDropdown && (
                        <div className="absolute right-0 -top-16 mt-2 w-56 rounded-md bg-white shadow-lg">
                            <div className="border-t border-gray-200 flex flex-col">
                                <NavLink href={route('profile.edit')} active className="py-3">Profile</NavLink>
                                <NavLink method="post" href={route('logout')} as="button" active className="py-3">
                                    Log Out
                                </NavLink>
                            </div>
                        </div>
                    )}
                    <div className="border-t border-gray-200 py-4 cursor-pointer" onClick={toggleDropdown}>
                        <div className="px-4">
                            <div className="font-medium text-base text-gray-800">
                                {user.name}
                            </div>
                            <div className="font-medium text-sm text-gray-500">{user.email}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div className="flex flex-col flex-1 ml-64">
                {header && (
                    <header className="bg-white shadow">
                        <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">{header}</div>
                    </header>
                )}
                <main>{children}</main>
            </div>
        </div>
    );
}
