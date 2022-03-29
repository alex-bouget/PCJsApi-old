from setuptools import setup

setup(
    name="pcjs_api",
    version="1.0",
    description="Php cursor",
    url="https://github.com/MisterMine01/PCJsApi",
    author="MisterMine01",
    py_modules=['pcjs_api'],
    package_dir={"": "Client/"},
    install_requires=[
        "requests"
    ],
    classifiers=[
        "Development Status :: 3 - Alpha",
        "Intended Audience :: Developers",
        "Programming Language :: Python :: 3"
    ],
    keywords=["server", "cursor"]
)
